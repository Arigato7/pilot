<?php

namespace Pilot;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Material extends Model
{
    use SoftDeletes;
    use Searchable;

    /**
     * @todo Исправить ошибку при поиске материала
     */

    protected $dates = ['deleted_at'];
    protected $fillable = [
        'user_id', 
        'name', 
        'specialty_id', 
        'subject_id',
        'material_type_id',
        'description',
        'content',
        'deleted',
        'status',
        'rate'
    ]; 
    protected $hidden = [];
    public function author() {
        return $this->belongsTo('Pilot\User');
    }
    public function type() {
        return $this->belongsTo('Pilot\MaterialType');
    }
    public function specialty() {
        return $this->belongsTo('Pilot\Specialty');
    }
    public function subject() {
        return $this->belongsTo('Pilot\Subject');
    }
    public function comments() {
        return $this->hasMany('Pilot\MaterialComment');
    }
    public function complaints() {
        return $this->hasMany('Pilot\MaterialComplaint');
    }
}
