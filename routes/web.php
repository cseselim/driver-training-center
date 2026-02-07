<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Student-Driver front-end routes
Route::group(['middleware' => ['web', 'auth']], function () {
    Route::get('/student-driver/student-dashboard', [App\Http\Controllers\StudentDriverController::class, 'studentAvailableDrivers'])->name('student-driver.student-dashboard');
    Route::post('/student-driver/request', [App\Http\Controllers\StudentDriverController::class, 'studentRequestDriver'])->name('student-driver.student-request');
    Route::delete('/student-driver/request/{id}', [App\Http\Controllers\StudentDriverController::class, 'studentRejectDriver'])->name('student-driver.student-reject');

    Route::get('/student-driver/driver-dashboard', [App\Http\Controllers\StudentDriverController::class, 'driverAvailableStudents'])->name('student-driver.driver-dashboard');
    Route::post('/student-driver/select', [App\Http\Controllers\StudentDriverController::class, 'driverSelectStudent'])->name('student-driver.driver-select');
    Route::delete('/student-driver/remove/{id}', [App\Http\Controllers\StudentDriverController::class, 'driverRemoveStudent'])->name('student-driver.driver-remove');
});
