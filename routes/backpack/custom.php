<?php

use Illuminate\Support\Facades\Route;
use App\Models\Course;
// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\CRUD.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix' => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace' => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    // Custom MyAccount routes with proper validation
    Route::get('edit-account-info', 'MyAccountController@getAccountInfoForm')->name('backpack.account.info');
    Route::post('edit-account-info', 'MyAccountController@postAccountInfoForm')->name('backpack.account.info.store');
    Route::post('change-password', 'MyAccountController@postChangePasswordForm')->name('backpack.account.password');

    // Admin only routes
    Route::middleware('role:admin')->group(function () {
        Route::crud('admin', 'AdminCrudController');
        Route::crud('student', 'StudentCrudController');
        Route::crud('driver', 'DriverCrudController');
        Route::crud('driver-student', 'DriverStudentCrudController');
        Route::crud('student-driver', 'StudentDriverCrudController');
    });

    // Driver routes
    Route::middleware('role:driver')->group(function () {
        Route::crud('driver-student', 'DriverStudentCrudController');
    });

    // Student routes
    Route::middleware('role:student')->group(function () {
        Route::crud('student-driver', 'StudentDriverCrudController');
    });

    Route::get('course-details/{id}', function ($id) {
        $course = Course::select('course_name', 'regular_course_fee', 'actual_course_fee', 'total_class', 'per_class_duration', 'total_duration')->find($id);
        return $course ?? [];
    });
}); // this should be the absolute last line of this file

/**
 * DO NOT ADD ANYTHING HERE.
 */
