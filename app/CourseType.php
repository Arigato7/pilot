<?php

namespace Pilot;

use Illuminate\Database\Eloquent\Model;

class CourseType extends Model
{
    protected $fillable = [
        'name'
    ];
    /**
     * Курсы с подобным типом
     *
     * @return void
     */
    public function courses() {
        return $this->hasMany('Pilot\Course');
    }
}
