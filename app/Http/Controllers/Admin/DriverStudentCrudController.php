<?php

namespace App\Http\Controllers\Admin;

use App\Models\DriverStudent;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Validation\Rule;

/**
 * Class DriverStudentCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class DriverStudentCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(DriverStudent::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/driver-student');
        CRUD::setEntityNameStrings('driver-student assignment', 'driver-student assignments');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
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

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
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

        // Prevent creating duplicate driver+student pairs
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

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();

        // Adjust validation for update: allow the current entry to keep its pair
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
