<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ServiceRequestResource;
use App\Media;
use App\Rules\ModelType;
use App\ServiceRequest;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Http\Request;

/**
 * @package Hire Talents
 * @author  Abhishek Prakash <prakashabhishek6262@gmail.com>
 */
class ServiceRequestController extends Controller
{
    public function show($id) {
        $service_request = ServiceRequest::with([
                                'acceptedBid',
                                'bids',
                                'media',
                                'options',
                                'owner',
                                'service',
                            ])->findOrFail($id);

        return new ServiceRequestResource($service_request);
    }

    public function index(Request $request) {
        $data = $request->validate([
            'owner_id'    => 'required|int',
            'owner_type'  => [
                'required',
                'string',
                new ModelType,
            ],
        ]);

        $model = Relation::getMorphedModel($data['owner_type']);

        $service_requests = ServiceRequest::with([
                                'acceptedBid',
                                'bids',
                                'media',
                                'options',
                                'owner',
                                'service',
                            ])
                                ->where(function ($query) use ($data, $model) {
                                    $query->where('owner_id', $data['owner_id'])
                                        ->where('owner_type', $model);
                                });

        return ServiceRequestResource::collection($service_requests->get());
    }

    public function store(Request $request) {
        $data = $request->validate([
            'description' => 'required|string',
            'media.*'     => 'image',
            'meta'        => 'required|string',
            'service_id'  => 'required|exists:services,id',
            'owner_id'    => 'required|int',
            'owner_type'  => [
                'required',
                'string',
                new ModelType,
            ]
        ]);

        $model = Relation::getMorphedModel($data['owner_type']);
        $owner = (new $model)->findOrFail($data['owner_id']);

        $meta = json_decode($data['meta'], true);

        $service_request = ServiceRequest::create($data);
        $service_request = $service_request->owner()->associate($owner);
        $service_request->save();

        $service_request->saveMeta($meta);

        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $media) {
                Media::store($media, $service_request);
            }
        }

        return new ServiceRequestResource($service_request);
    }
}
