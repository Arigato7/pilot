<?php

namespace Pilot;

use Illuminate\Database\Eloquent\Model;

class MaterialComment extends Model
{
    protected $fillable = [
        'material_id', 'user_id', 'description', 'review'
    ];
    public function author() {
        return $this->belongsTo('Pilot\User');
    }
    public function material() {
        return $this->belongsTo('Pilot\Material');
    }
}
