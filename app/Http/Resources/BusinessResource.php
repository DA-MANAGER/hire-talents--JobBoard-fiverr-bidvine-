<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @package Hire Talents
 * @author  Abhishek Prakash <prakashabhishek6262@gmail.com>
 */
class BusinessResource extends JsonResource
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
            'name' => $this->name,
            'address' => $this->address,
            'description' => $this->description,
            'email' => $this->email,
            'phone' => $this->phone,
            'founding_year' => $this->founding_year,
            'level' => $this->level,
            'avatar' => $this->brandAvatar,
            'owners' => $this->owners,
            'services' => $this->when($this->services, $this->services),
            'type' => $this->type,
            'website' => $this->website,
            'zipcode' => $this->zipcode,
        ];
    }
}
