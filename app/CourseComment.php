<?php

namespace Pilot;

use Illuminate\Database\Eloquent\Model;

class CourseComment extends Model
{
    protected $fillable = [
        'course_id',
        'user_id',
        'description',
        'date'
    ];
    /**
     * Автор комментария к курсу
     *
     * @return void
     */
    public function author() {
        return $this->belongsTo('Pilot\User');
    }
    /**
     * Курс
     *
     * @return void
     */
    public function course() {
        return $this->belongsTo('Pilot\Course');
    }
}
