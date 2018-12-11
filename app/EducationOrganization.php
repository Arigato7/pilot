<?php

namespace Pilot;

use Illuminate\Database\Eloquent\Model;

class EducationOrganization extends Model
{
    protected $fillable = [
        'shortname',
        'name',
        'phone',
        'address',
        'cite',
        'rate',
        'photo',
        'description'
    ];
    /**
     * Пользователи с подобной образовательной организацией
     *
     * @return void
     */
    public function users() {
        return $this->hasMany('Pilot\UserInfo');
    }
}
