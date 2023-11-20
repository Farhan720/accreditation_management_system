<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    protected $guarded = [];

    public function department(){
        $this->belongsTo('App\Department');
    }
    public function subject()
    {
        return $this->hasMany('App\Subject');
    }
}
