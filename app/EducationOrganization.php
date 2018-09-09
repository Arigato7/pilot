<?php

namespace Pilot;

use Illuminate\Database\Eloquent\Model;

class EducationOrganization extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'address',
        'cite',
        'email',
        'rate'
    ];
    public function users() {
        return $this->hasMany('Pilot\UserInfo');
    }
}
