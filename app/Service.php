<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @package Hire Talents
 * @author  Abhishek Prakash <prakashabhishek6262@gmail.com>
 */
class Service extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Returns the businesses offering the service.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function businesses() {
        return $this->belongsToMany(Business::class, 'business_services');
    }

    /**
     * Returns the icon for the service.
     * 
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function media() {
        return $this->morphMany(Media::class, 'owner')->latest()->first();
    }

    /**
     * Returns the questions assigned to the service.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function questions() {
        return $this->hasMany(ServiceQuestion::class, 'service_id');
    }
}
