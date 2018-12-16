<?php

namespace Pilot;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = [
        'user_id',
        'header',
        'image',
        'description'
    ];
    public function author() {
        return $this->belongsTo('Pilot\User');
    }
}
