<?php

namespace Pilot;

use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{
    protected $fillable = [
        'specialty_type_id',
        'name'
    ];
    public function materials() {
        return $this->hasMany('Pilot\Material');
    }
    public function type() {
        return $this->belongsTo('Pilot\SpecialtyType');
    }
}
