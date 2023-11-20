<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $guarded = [];

    public function subjects()
    {
        return $this->hasMany('App\Subject');
    }
    public function teachers()
    {
        return $this->hasMany('App\Teacher');
    }

    public function semesters(){
        return $this->hasMany('App\Semester');
    }
}
