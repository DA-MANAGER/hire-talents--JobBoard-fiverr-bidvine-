<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @package Hire Talents
 * @author  Abhishek Prakash <prakashabhishek6262@gmail.com>
 */
class ServiceRequest extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'accepted_bid_id',
        'description',
        'service_id',
        'status',
    ];

    public function getMeta() {
        return $this->options()->get();
    }

    /**
     * Set the meta attribute of the service request.
     * 
     * @param  array data
     * 
     * @return void
     */
    public function saveMeta(array $data) {
        foreach ($data as $meta) {
            ['key' => $key, 'value' => $value] = $meta;

            $this->options()->updateOrCreate(
                ['key' => $key],
                ['value' => json_encode($value)]
            );
        }
    }

    /**
     * Returns the accepted bid for the service request.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function acceptedBid() {
        return $this->belongsTo(Bid::class, 'accepted_bid_id');
    }

    /**
     * Returns all the bids that belongs to the service request.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bids() {
        return $this->hasMany(Bid::class, 'service_request_id');
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
     * Returns all the options registered by the service request.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function options() {
        return $this->morphMany(Option::class, 'owner');
    }

    /**
     * Returns the owner of the service request.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function owner() {
        return $this->morphTo();
    }

    /**
     * Returns the service associcated to the service request.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function service() {
        return $this->belongsTo(Service::class, 'service_id');
    }
}
