<?php

namespace Pilot;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    protected $fillable = [
        'user_id',
        'position_id',
        'name', 
        'lastname', 
        'middlename',
        'about',
        'photo'
    ];
    /**
     * 
     */
    public function user() {
        return $this->belongsTo('Pilot\User');
    }
    /**
     * 
     */
    public function educationOrganization() {
        return $this->belongsTo('Pilot\EducationOrganization');
    }
    /**
     * 
     */
    public function position() {
        return $this->belongsTo('Pilot\Position');
    }
}
