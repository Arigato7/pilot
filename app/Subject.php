<?php

namespace Pilot;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = [
        'name'
    ];

    /**
     * Undocumented function
     *
     * @return void
     */
    public function materials() {
        return $this->hasMany('Pilot\Material');
    }
    /**
     * Практические работы
     *
     * @return void
     */
    public function practicalWorks() {
        return $this->hasMany('Pilot\PracticalWork');
    }
}
