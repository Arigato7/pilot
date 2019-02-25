<?php

namespace Pilot;

use Illuminate\Database\Eloquent\Model;

class SystemConfig extends Model
{
    protected $fillable = [
        'name',
        'value'
    ];
}
