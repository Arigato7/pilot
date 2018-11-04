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
    /**
     * Пользователь записавшийся на курс
     *
     * @return void
     */
    public function user() {
        return $this->belongsTo('Pilot\User');
    }
    /**
     * Курс, на который записались 
     *
     * @return void
     */
    public function course() {
        return $this->belongsTo('Pilot\Course');
    }
}
