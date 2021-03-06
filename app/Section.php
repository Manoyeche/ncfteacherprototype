<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Section extends Model
{
    use SoftDeletes;
    
    protected $guarded = [];

    public function students() {
        return $this->hasMany('App\SectionStudent');
    }
}
