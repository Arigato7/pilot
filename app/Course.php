<?php

namespace Pilot;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'user_id',
        'course_type_id',
        'name',
        'start_date',
        'end_date',
        'place',
        'description'
    ];

    public function author() {
        return $this->belongsTo('Pilot\User');
    }
    public function type() {
        return $this->belongsTo('Pilot\CourseType');
    }
    public function records() {
        return $this->hasMany('Pilot\CourseRecord');
    }
    public function comments() {
        return $this->hasMany('Pilot\CourseComment');
    }
}
