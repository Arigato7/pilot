<?php

namespace Pilot;

use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{
    protected $fillable = [
        'specialty_type_id',
        'name',
        'code'
    ];
    /**
     * Материалы
     *
     * @return void
     */
    public function materials() {
        return $this->hasMany('Pilot\Material');
    }
    /**
     * Тип специальности
     *
     * @return void
     */
    public function type() {
        return $this->belongsTo('Pilot\SpecialtyType');
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
