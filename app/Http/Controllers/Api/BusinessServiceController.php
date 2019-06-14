<?php

namespace App\Http\Controllers\Api;

use App\Business;
use App\Constants\BusinessPermissionError;
use App\Exceptions\NoPermissionException;
use App\Http\Controllers\Controller;
use App\Http\Resources\ServiceResource;
use Illuminate\Http\Request;

/**
 * @package Hire Talents
 * @author  Abhishek Prakash <prakashabhishek6262@gmail.com>
 */
class BusinessServiceController extends Controller
{
    /**
     * Removes the service subscribed by the business.
     *
     * @param $business_id
     * @param $service_id
     *
     * @return ServiceResource
     * @throws NoPermissionException
     */
    public function destroy($business_id, $service_id) {
        $business = Business::with([
            'owners',
            'services',
        ])->findOrFail($business_id);

        if (! $business->isMasterOwnedBy(auth()->user())) {
            throw new NoPermissionException(BusinessPermissionError::UPDATE);
        }

        $business->services()->detach($service_id);

        return ServiceResource::collection($business->services);
    }

    /**
     * Lists all the services provided by the business.
     *
     * @param int $business_id
     *
     * @return ServiceResource
     * @throws NoPermissionException
     */
    public function index($business_id) {
        $business = Business::with('services')->findOrFail($business_id);

        return ServiceResource::collection($business->services);
    }

    /**
     * Registers a new service to the business.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $business_id
     *
     * @return ServiceResource
     * @throws NoPermissionException
     */
    public function store(Request $request, $business_id) {
        $business = Business::with([
            'owners',
            'services',
        ])->findOrFail($business_id);

        if (! $business->isMasterOwnedBy(auth()->user())) {
            throw new NoPermissionException(BusinessPermissionError::UPDATE);
        }

        $data = $request->validate([
            'service_id' => 'required|exists:services,id',
        ]);

        $business->services()->syncWithoutDetaching($data['service_id']);

        return ServiceResource::collection($business->services);
    }
}
