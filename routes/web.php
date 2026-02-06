<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DriverStudentController;

Route::get('/', function () {
    return view('welcome');
});

// Driver-Student Assignment Routes
Route::middleware(['auth'])->group(function () {
    // Student routes
    Route::get('/student/drivers', [DriverStudentController::class, 'studentAvailableDrivers'])
        ->name('driver-student.student-dashboard');

    Route::post('/student/request-driver', [DriverStudentController::class, 'studentRequestDriver'])
        ->name('driver-student.student-request');

    Route::delete('/student/reject-driver/{id}', [DriverStudentController::class, 'studentRejectDriver'])
        ->name('driver-student.student-reject');

    // Driver routes
    Route::get('/driver/students', [DriverStudentController::class, 'driverAvailableStudents'])
        ->name('driver-student.driver-dashboard');

    Route::post('/driver/select-student', [DriverStudentController::class, 'driverSelectStudent'])
        ->name('driver-student.driver-select');

    Route::delete('/driver/remove-student/{id}', [DriverStudentController::class, 'driverRemoveStudent'])
        ->name('driver-student.driver-remove');
});
