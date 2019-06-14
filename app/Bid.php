<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @package Hire Talents
 * @author  Abhishek Prakash <prakashabhishek6262@gmail.com>
 */
class Bid extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description',
        'amount',
        'business_id',
        'service_request_id',
    ];

    /**
     * Returns the business thats the owner of the bid.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function business() {
        return $this->belongsTo(Business::class, 'business_id');
    }

    /**
     * Returns all the media attached to the service request.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function media() {
        return $this->morphMany(Media::class, 'owner');
    }

    /**
     * Returns the service request to which the bid belongs.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function serviceRequest() {
        return $this->belongsTo(ServiceRequest::class, 'service_request_id');
    }
}
