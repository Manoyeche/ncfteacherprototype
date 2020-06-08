<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $guarded = [];

    protected $appends = [
        'fullname',
    ];

    
    // ///////////////////
    // APPENDS

    public function getFullnameAttribute()
    {
        return trim(preg_replace('/\s+/', ' ', join(' ', [
            $this->first_name,
            $this->middle_name,
            $this->last_name,
            $this->suffix
        ])));
    }

    
    // ///////////////////
    // RELATIONS

    public function user() {
        return $this->belongsTo('App\User');
    }
}
