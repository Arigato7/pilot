<?php

namespace Pilot;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'login', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role() {
        return $this->belongsTo('Pilot\Role');
    }
    public function userInfo() {
        return $this->hasOne('Pilot\UserInfo');
    }
    public function materials() {
        return $this->hasMany('Pilot\Material');
    }
    public function news() {
        return $this->hasMany('Pilot\News');
    }
    public function materialComments() {
        return $this->hasMany('Pilot\MaterialComment');
    }
    public function materialComplaints() {
        return $this->hasMany('Pilot\MaterialComplaint');
    }
}
