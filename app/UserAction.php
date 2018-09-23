<?php

namespace Pilot;

use Illuminate\Database\Eloquent\Model;

class UserAction extends Model
{
    protected $fillable = [
        'user_id',
        'description'
    ];

    public function user() {
        
    }
}
