<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'courses';

    protected $fillable = [
        'course_name',
        'regular_course_fee',
        'actual_course_fee',
        'image',
        'remark',
        'total_class',
        'per_class_duration',
        'total_duration',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    // If one course has many students
    // public function students()
    // {
    //     return $this->hasMany(Student::class);
    //     // অথবা যদি students users table-এ থাকে:
    //     // return $this->hasMany(User::class);
    // }
}
