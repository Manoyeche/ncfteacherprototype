<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'user_type', 'temp_password',
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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin() {
        return $this->user_type == 0;
    }

    public function isTeacher() {
        return $this->user_type == 1;
    }

    public function isStudent() {
        return $this->user_type == 2;
    }



    // ///////////////////
    // RELATIONS

    public function profile() {
        return $this->hasOne('App\UserProfile', 'user_id', 'id');
    }

    public function studentProfile() {
        return $this->hasOne('App\StudentProfile', 'user_id', 'id');
    }
}
