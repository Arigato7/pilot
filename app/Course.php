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
        'end_entry_date',
        'duration',
        'place',
        'description'
    ];
    /**
     * Автор курса
     *
     * @return void
     */
    public function author() {
        return $this->belongsTo('Pilot\User');
    }
    /**
     * Тип курса
     *
     * @return void
     */
    public function type() {
        return $this->belongsTo('Pilot\CourseType');
    }
    /**
     * Записи на курс
     *
     * @return void
     */
    public function records() {
        return $this->hasMany('Pilot\CourseRecord');
    }
    /**
     * Комментарии к курсу
     *
     * @return void
     */
    public function comments() {
        return $this->hasMany('Pilot\CourseComment');
    }
}
