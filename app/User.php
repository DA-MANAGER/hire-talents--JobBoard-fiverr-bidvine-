<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

/**
 * @package Hire Talents
 * @author  Abhishek Prakash <prakashabhishek6262@gmail.com>
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'address',
        'avatar',
        'dob',
        'email',
        'first_name',
        'last_name',
        'password',
        'phone',
        'zipcode',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Returns all the businesses the user owns.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function businesses() {
        return $this->belongsToMany(Business::class, 'business_owners', 'user_id');
    }

    /**
     * Returns all the media uploaded by the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function media() {
        return $this->morphMany(Media::class, 'owner');
    }

    /**
     * Returns all the options or settings created for the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function options() {
        return $this->morphMany(Option::class, 'owner');
    }

    /**
     * Returns all the reviews written by the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function reviewed() {
        return $this->morphMany(Review::class, 'reviewer');
    }

    /**
     * Returns all the reviews made for the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function reviews() {
        return $this->morphMany(Review::class, 'reviewee');
    }
}
