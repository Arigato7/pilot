<?php

namespace Pilot;

use Illuminate\Database\Eloquent\Model;

class MaterialComplaint extends Model
{
    protected $fillable = [
        'user_id',
        'material_id',
        'description',
    ];

    public function author() {
        return $this->belongsTo('Pilot\User');
    }
    public function material() {
        return $this->belongsTo('Pilot\Material');
    }
}
