<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StudentDriver;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Backpack\CRUD\app\Http\Controllers\CrudController;

class ScheduleController extends CRUDController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    public function setup()
    {
        CRUD::setModel(StudentDriver::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/student-driver');
        CRUD::setEntityNameStrings('student-driver assignment', 'student-driver assignments');
        CRUD::setEntityNameStrings('Schedule', 'Schedules');

        // Filter by role: students see only their own, drivers see only their assignments, admins see all
        $user = backpack_user();
        if ($user->role === 'student') {
            CRUD::addClause('where', 'student_id', '=', $user->id);
        } elseif ($user->role === 'driver') {
            CRUD::addClause('where', 'driver_id', '=', $user->id);
        }
    }

    protected function setupListOperation()
    {
        CRUD::column('driver_id')
            ->label('Driver')
            ->type('closure')
            ->function(function ($entry) {
                return $entry->driver?->name ?? '-';
            })
            ->searchLogic(function ($query, $column, $searchTerm) {
                return $query->orWhereHas('driver', function ($q) use ($searchTerm) {
                    $q->where('name', 'like', '%' . $searchTerm . '%');
                });
            });

        CRUD::column('student_id')
            ->label('Student')
            ->type('closure')
            ->function(function ($entry) {
                return $entry->student?->name ?? '-';
            })
            ->searchLogic(function ($query, $column, $searchTerm) {
                return $query->orWhereHas('student', function ($q) use ($searchTerm) {
                    $q->where('name', 'like', '%' . $searchTerm . '%');
                });
            });

        CRUD::column('car_type')->label('Car Type');
        CRUD::column('next_date')->label('Next Date & Time');
        CRUD::column('number_of_class')->label('Number of Class');

        CRUD::column('created_at')
            ->label('Created');
    }
}
