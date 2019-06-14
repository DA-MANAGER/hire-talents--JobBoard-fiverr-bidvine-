<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @package Hire Talents
 * @author  Abhishek Prakash <prakashabhishek6262@gmail.com>
 */
class ServiceQuestion extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'question',
        'visibility_type'
    ];

    /**
     * Returns the options assigned to the question.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function options() {
        return $this->hasMany(ServiceQuestionOption::class, 'service_question_id');
    }
}
