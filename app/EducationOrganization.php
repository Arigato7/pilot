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
    /**
     * Пользователи с подобной образовательной организацией
     *
     * @return void
     */
    public function users() {
        return $this->hasMany('Pilot\UserInfo');
    }
}
