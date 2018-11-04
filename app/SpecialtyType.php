<?php

namespace Pilot;

use Illuminate\Database\Eloquent\Model;

class SpecialtyType extends Model
{
    protected $fillable = [
        'name'
    ];
    public function specialties() {
        return $this->hasMany('Pilot\Specialty');
    }
}
