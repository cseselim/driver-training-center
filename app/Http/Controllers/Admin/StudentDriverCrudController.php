<?php

namespace App\Http\Controllers\Admin;

use App\Models\DriverStudent;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Validation\Rule;

/**
 * Class StudentDriverCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class StudentDriverCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        CRUD::setModel(DriverStudent::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/student-driver');
        CRUD::setEntityNameStrings('student-driver assignment', 'student-driver assignments');
    }

    protected function setupListOperation()
    {
        CRUD::column('driver_id')
            ->label('Driver')
            ->type('closure')
            ->function(function ($entry) {
                return $entry->driver?->name ?? '-';
            });

        CRUD::column('student_id')
            ->label('Student')
            ->type('closure')
            ->function(function ($entry) {
                return $entry->student?->name ?? '-';
            });

        CRUD::column('status')
            ->label('Status')
            ->type('select_from_array')
            ->options([
                'pending' => 'Pending',
                'accepted' => 'Accepted',
                'rejected' => 'Rejected',
            ]);

        CRUD::column('notes')
            ->label('Notes');

        CRUD::column('created_at')
            ->label('Created');
    }

    protected function setupCreateOperation()
    {
        CRUD::field('driver_id')
            ->type('select')
            ->label('Driver')
            ->options(function () {
                return \App\Models\User::where('role', 'driver')->pluck('name', 'id');
            });

        CRUD::field('student_id')
            ->type('select')
            ->label('Student')
            ->options(function () {
                return \App\Models\User::where('role', 'student')->pluck('name', 'id');
            });

        CRUD::field('status')
            ->type('select_from_array')
            ->options([
                'pending' => 'Pending',
                'accepted' => 'Accepted',
                'rejected' => 'Rejected',
            ])
            ->default('pending')
            ->label('Status');

        CRUD::field('notes')
            ->type('textarea')
            ->label('Notes');

        CRUD::setValidation([
            'driver_id' => 'required|exists:users,id',
            'student_id' => [
                'required',
                'exists:users,id',
                Rule::unique('driver_student')->where(function ($query) {
                    return $query->where('driver_id', request('driver_id'));
                }),
            ],
            'status' => 'required|in:pending,accepted,rejected',
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();

        $entryId = $this->crud->getCurrentEntryId();
        CRUD::setValidation([
            'driver_id' => 'required|exists:users,id',
            'student_id' => [
                'required',
                'exists:users,id',
                Rule::unique('driver_student')->where(function ($query) use ($entryId) {
                    return $query->where('driver_id', request('driver_id'));
                })->ignore($entryId),
            ],
            'status' => 'required|in:pending,accepted,rejected',
        ]);
    }
}
