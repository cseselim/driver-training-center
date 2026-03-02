<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeSchedule extends Model
{
    use HasFactory;

    // Table name (optional, Laravel default would be 'time_schedules')
    protected $table = 'time_schedule';

    // Mass assignable fields
    protected $fillable = [
        'schedule_name',
        'remarks',
        'status',
    ];

    // Casts for specific data types
    protected $casts = [
        'status' => 'boolean', // ensures status is always true/false
    ];

    // Optional: default values
    protected $attributes = [
        'status' => true,
    ];
}
