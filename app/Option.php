<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @package Hire Talents
 * @author  Abhishek Prakash <prakashabhishek6262@gmail.com>
 */
class Option extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'key',
        'value',
    ];

    public static function getSiteOptions() {
        $options = new static;

        return $options->where(function ($query) {
            $query->whereNull('owner_id')->whereNull('owner_type');
        })->get();
    }

    /**
     * Returns the owner of the option or setting.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function owner() {
        return $this->morphTo();
    }
}
