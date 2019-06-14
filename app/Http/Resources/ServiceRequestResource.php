<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @package Hire Talents
 * @author  Abhishek Prakash <prakashabhishek6262@gmail.com>
 */
class ServiceRequestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'accepted_bid' => new BidResource($this->acceptedBid),
            'bids' => BidResource::collection($this->bids),
            'description' => $this->description,
            'media' => MediaResource::collection($this->media),
            'meta' => OptionResource::collection($this->getMeta()),
            'owner' => $this->owner,
            'service' => new ServiceResource($this->service),
            'status' => $this->status,
        ];
    }
}
