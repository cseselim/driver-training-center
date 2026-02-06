<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\app\Models\Traits\CrudTrait;

class DriverStudent extends Model
{
    use HasFactory, CrudTrait;

    protected $table = 'driver_student';
    protected $guarded = ['id'];

    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}
