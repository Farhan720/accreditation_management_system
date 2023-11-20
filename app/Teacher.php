<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = [
    "department_id",
    "first_name" ,
    "last_name",
    "email",
    "cell",
    "qualification",
    "address"];

    public function department()
    {
        return $this->belongsTo('department');
    }
}
