<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @package Hire Talents
 * @author  Abhishek Prakash <prakashabhishek6262@gmail.com>
 */
class Review extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'rating',
        'review',
    ];

    /**
     * Returns the reviewee being reviewed.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function reviewee() {
        return $this->morphTo();
    }

    /**
     * Returns the reviewer reviewed the reviewee.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function reviewer() {
        return $this->morphTo();
    }
}
