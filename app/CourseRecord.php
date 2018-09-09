<?php

namespace Pilot;

use Illuminate\Database\Eloquent\Model;

class CourseRecord extends Model
{
    protected $fillable = [
        'course_id',
        'user_id',
        'date'
    ];

    public function user() {
        return $this->belongsTo('Pilot\User');
    }
    public function course() {
        return $this->belongsTo('Pilot\Course');
    }
}
