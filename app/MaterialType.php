<?php

namespace Pilot;

use Illuminate\Database\Eloquent\Model;

class MaterialType extends Model
{
    protected $fillable = [
        'name'
    ];
    public function materials() {
        return $this->hasMany('Pilot\Material');
    }
}
