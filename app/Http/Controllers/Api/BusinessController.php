<?php

namespace App\Http\Controllers\Api;

use App\Business;
use App\Constants\BusinessPermissionError;
use App\Exceptions\NoPermissionException;
use App\Http\Controllers\Controller;
use App\Http\Resources\BusinessResource;
use App\Media;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * @package Hire Talents
 * @author  Abhishek Prakash <prakashabhishek6262@gmail.com>
 */
class BusinessController extends Controller
{
    /**
     * Deletes the business.
     *
     * @param int $business_id
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws NoPermissionException
     */
    public function destroy($business_id) {
        $business = Business::with('owners')->findOrFail($business_id);
        $user     = auth()->user();

        if (! $business->isMasterOwnedBy($user)) {
            throw new NoPermissionException(BusinessPermissionError::DELETE);
        }

        $business->delete();

        return response('', 200);
    }

    /**
     * Returns the businesses.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request) {
        $request->validate([
            'user_id' => 'exists:users,id',
        ]);

        $businesses = Business::with(['brandAvatar', 'owners']);

        if ($request->has('user_id')) {
            $user_id = $request->input('user_id');

            $businesses->whereHas('owners', function ($query) use ($user_id) {
                $query->where('user_id', $user_id);
            });
        }

        $businesses = QueryBuilder::for($businesses)
            ->allowedIncludes([
                'media',
                'reviews',
                'services',
            ]);

        return BusinessResource::collection($businesses->get());
    }

    /**
     * Returns the business with the supplied id.
     *
     * @param $business_id
     *
     * @return BusinessResource
     */
    public function show($business_id) {
        return new BusinessResource(
            Business::with([
                'brandAvatar',
                'media',
                'owners',
                'reviews',
                'services',
            ])->findOrFail($business_id)
        );
    }

    /**
     * Registers a new business.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return BusinessResource
     */
    public function store(Request $request) {
        $data = $request->validate([
            'name'               => 'required|string',
            'registration_number' => 'required_if:type,limited-company,limited-liability-partnership|string|unique:businesses,registration_number',
            'type'               => 'required|string',
            'zipcode'            => 'required|string',
        ]);

        $data['level'] = 'basic';

        $user = auth()->user();
        $business = $user->businesses()->create($data);

        return new BusinessResource($business);
    }

    /**
     * Update the details of the business.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $business_id
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws NoPermissionException
     */
    public function update(Request $request, $business_id) {
        $business = Business::with('owners')->findOrFail($business_id);
        $user     = auth()->user();

        if (! $business->isMasterOwnedBy($user)) {
           throw new NoPermissionException(BusinessPermissionError::UPDATE);
        }

        $data = $request->validate([
            'address'       => 'string|nullable',
            'description'   => 'string|nullable',
            'founding_year' => 'integer|nullable',
            'email'         => 'email|nullable',
            'avatar'          => 'image|nullable',
            'name'          => 'string|nullable',
            'phone'         => 'string|nullable',
            'type'          => 'string',
            'website'       => 'url|nullable',
            'zipcode'       => 'string|nullable',
        ]);

        if ($request->hasFile('avatar')) {
            $media = Media::store($request->file('avatar'), $business);
            $data['avatar'] = $media->id;
        }

        $business->update($data);

        return new BusinessResource($business);
    }
}
