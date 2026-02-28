<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Backpack\CRUD\app\Models\Traits\CrudTrait;

class StudentDriver extends Model
{
    use HasFactory, CrudTrait;

    protected $table = 'student_driver';

    protected $fillable = [
        'student_id',
        'driver_id',
        'car_type',
        'time_schedule',
        'next_date',
        'number_of_class',
    ];

    // Optional: Relationships
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }
}
