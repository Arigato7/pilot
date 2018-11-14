<?php

namespace Pilot;

use Illuminate\Database\Eloquent\Model;

class RegisterApplication extends Model
{
    protected $fillable = [
        'name',
        'lastname',
        'login',
        'email',
        'phone'
    ];
}
