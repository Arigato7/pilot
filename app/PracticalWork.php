<?php

namespace Pilot;

use Illuminate\Database\Eloquent\Model;

class PracticalWork extends Model
{
    protected $fillable = [
        'user_id',
        'specialty_id',
        'subject_id',
        'name',
        'resource',
        'description',
        'date'
    ];
    /**
     * Автор практической работы
     *
     * @return void
     */
    public function author() {
        return $this->belongsTo('Pilot\User');
    }
    /**
     * Специальность
     *
     * @return void
     */
    public function specialty() {
        return $this->belongsTo('Pilot\Specialty');
    }
    /**
     * Дисциплина
     *
     * @return void
     */
    public function subject() {
        return $this->belongsTo('Pilot\Subject');
    }
}
