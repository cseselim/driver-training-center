<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\DriverStudentRequest;
use App\Models\DriverStudent;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

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
        CRUD::setValidation(DriverStudentRequest::class);

        CRUD::field('driver_id')
            ->type('select')
            ->label('Driver')
            ->options(function () {
                return \App\Models\User::where('role', 'driver')->get()->mapWithKeys(function ($u) {
                    $start = $u->start_date ? \Carbon\Carbon::parse($u->start_date)->format('Y-m-d H:i') : '-';
                    $end = $u->end_date ? \Carbon\Carbon::parse($u->end_date)->format('Y-m-d H:i') : '-';
                    return [$u->id => $u->name . ' (' . $start . ' - ' . $end . ')'];
                })->toArray();
            });

        CRUD::field('student_id')
            ->type('select')
            ->label('Student')
            ->options(function () {
                return \App\Models\User::where('role', 'student')->pluck('name', 'id');
            });

        // Assignment date - ensure one student can have one driver per date
        CRUD::field('assignment_date')
            ->type('date')
            ->label('Assignment Date');

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
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update()
    {
        $response = parent::update();

        // Redirect to list after successful update
        return redirect()->route($this->crud->route . '.index')->with('success', 'Student-driver assignment updated successfully.');
    }
}
