<?php

namespace Pilot;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = [
        'user_id',
        'header',
        'theme',
        'description',
        'content'
    ];
    public function author() {
        return $this->belongsTo('Pilot\User');
    }
}
