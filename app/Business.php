<?php

namespace App;

use App\Contracts\HasMasterOwner;
use Illuminate\Database\Eloquent\Model;

/**
 * @package Hire Talents
 * @author  Abhishek Prakash <prakashabhishek6262@gmail.com>
 */
class Business extends Model implements HasMasterOwner
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'address',
        'avatar',
        'description',
        'founding_year',
        'email',
        'level',
        'name',
        'phone',
        'registration_number',
        'type',
        'website',
        'zipcode',
    ];

    /**
     * Returns the avatar of the business.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function brandAvatar() {
        return $this->hasOne(Media::class, 'id', 'avatar');
    }

    /**
     * Returns all the media uploaded by the business.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function media() {
        return $this->morphMany(Media::class, 'owner');
    }

    /**
     * Returns all the options or settings created for the business.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function options() {
        return $this->morphMany(Option::class, 'owner');
    }

    /**
     * Returns the users that owns the business.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function owners() {
        return $this->belongsToMany(User::class, 'business_owners', 'business_id');
    }

    /**
     * Returns whether the user owns the business.
     *
     * @param  App\Model $model
     *
     * @return bool
     */
    public function isMasterOwnedBy(Model $model) : bool {
        return (bool) $this->owners->contains('id', $model->getKey());
    }

    /**
     * Returns all the reviews written by the business.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function reviewed() {
        return $this->morphMany(Review::class, 'reviewer');
    }

    /**
     * Returns all the reviews made for the business.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function reviews() {
        return $this->morphMany(Review::class, 'reviewee');
    }

    /**
     * Returns all the services offered by the business.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function services() {
        return $this->belongsToMany(Service::class, 'business_services');
    }
}
