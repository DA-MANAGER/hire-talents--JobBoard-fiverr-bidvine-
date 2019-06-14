<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @package Hire Talents
 * @author  Abhishek Prakash <prakashabhishek6262@gmail.com>
 */
class BidResource extends JsonResource
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
            'business' => new BusinessResource($this->business),
            'description' => $this->description,
            'media' => MediaResource::collection($this->media),
            'service_request' => [
                'id' => $this->service_request_id
            ],
        ];
    }
}
