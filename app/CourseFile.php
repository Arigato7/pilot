<?php

namespace Pilot;

use Illuminate\Database\Eloquent\Model;

class CourseFile extends Model
{
    protected $fillable = [
        'course_id',
        'alias',
        'fullname',
        'type'
    ];
    /**
     * Undocumented function
     *
     * @return void
     */
    public function course() {
        return $this->belongsTo('Pilot\Course');
    }
}
