<?php

namespace Pilot;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    public function materials() {
        return $this->hasMany('Pilot\Material');
    }
}
