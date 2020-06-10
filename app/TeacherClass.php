<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TeacherClass extends Model
{
    use SoftDeletes;
    
    protected $guarded = [];

    public function section() {
        return $this->belongsTo('App\Section');
    }

    public function subject() {
        return $this->belongsTo('App\Subject');
    }
}
