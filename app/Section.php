<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $guarded =[];

    public function department(){
        $this->belongsTo('App\Department');
    }
    public function semester(){
        $this->belongsTo('App\Semester');
    }
    public function subject()
    {
        return $this->hasMany('App\Subject');
    }
}
