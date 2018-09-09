<?php

namespace Pilot;

use Illuminate\Database\Eloquent\Model;

class CourseType extends Model
{
    protected $fillable = [
        'name'
    ];

    public function courses() {
        return $this->hasMany('Pilot\Course');
    }
}
