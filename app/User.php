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
    /**
     * Роль пользователя
     *
     * @return void
     */
    public function role() {
        return $this->belongsTo('Pilot\Role');
    }
    /**
     * Информация о пользователе
     *
     * @return void
     */
    public function userInfo() {
        return $this->hasOne('Pilot\UserInfo');
    }
    /**
     * Материалы пользователя
     *
     * @return void
     */
    public function materials() {
        return $this->hasMany('Pilot\Material');
    }
    /**
     * Новости пользователя
     *
     * @return void
     */
    public function news() {
        return $this->hasMany('Pilot\News');
    }
    /**
     * Курсы повышения квалификации пользователя
     *
     * @return void
     */
    public function courses() {
        return $this->hasMany('Pilot\Course');
    }
    /**
     * Записи пользователя на курсы повышения квалификации
     *
     * @return void
     */
    public function records() {
        return $this->hasMany('Pilot\CourseRecord');
    }
    /**
     * Комментарии пользователя к курсам
     *
     * @return void
     */
    public function courseComments() {
        return $this->hasMany('Pilot\CourseComment');
    }
    /**
     * Комментарии пользователя к материалам
     *
     * @return void
     */
    public function materialComments() {
        return $this->hasMany('Pilot\MaterialComment');
    }
    /**
     * Жалобы пользователя к материалам
     *
     * @return void
     */
    public function materialComplaints() {
        return $this->hasMany('Pilot\MaterialComplaint');
    }
    /**
     * Практические работы пользователя
     *
     * @return void
     */
    public function practicalWorks() {
        return $this->hasMany('Pilot\PracticalWork');
    }
}
