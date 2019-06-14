<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @package Hire Talents
 * @author  Abhishek Prakash <prakashabhishek6262@gmail.com>
 */
class ServiceQuestionResource extends JsonResource
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
            'options' => ServiceQuestionOptionResource::collection($this->options),
            'question' => $this->question,
            'service' => [
                'id' => $this->service_id,
            ],
            'visibility_type' => $this->visibility_type,
        ];
    }
}
