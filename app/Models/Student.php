<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{

    protected $table = "students";
    protected $fillable = [
        'full_name',
        'email',
        'phone',
        'dob',
        'gender',
        'address',
        'image',
    ];
}
