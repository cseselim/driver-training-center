<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\DriverStudentRequest;
use App\Models\DriverStudent;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

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

        // Filter by role: students see only their own, drivers see only their assignments, admins see all
        $user = backpack_user();
        if ($user->role === 'student') {
            CRUD::addClause('where', 'student_id', '=', $user->id);
        } elseif ($user->role === 'driver') {
            CRUD::addClause('where', 'driver_id', '=', $user->id);
        }
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

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(DriverStudentRequest::class);

        CRUD::field('driver_id')
            ->type('select')
            ->label('Driver')
            ->options(function () {
                $user = backpack_user();
                if ($user->role === 'driver') {
                    return \App\Models\User::where(['role' => 'driver', 'id' => $user->id])->get()->mapWithKeys(function ($u) {
                        $start = $u->start_date ? \Carbon\Carbon::parse($u->start_date)->format('Y-m-d H:i') : '-';
                        $end = $u->end_date ? \Carbon\Carbon::parse($u->end_date)->format('Y-m-d H:i') : '-';
                        return [$u->id => $u->name . ' (' . $start . ' - ' . $end . ')'];
                    })->toArray();
                } else {
                    return \App\Models\User::where('role', 'driver')->get()->mapWithKeys(function ($u) {
                        $start = $u->start_date ? \Carbon\Carbon::parse($u->start_date)->format('Y-m-d H:i') : '-';
                        $end = $u->end_date ? \Carbon\Carbon::parse($u->end_date)->format('Y-m-d H:i') : '-';
                        return [$u->id => $u->name . ' (' . $start . ' - ' . $end . ')'];
                    })->toArray();
                }
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
                'done' => 'Done',
                'rejected' => 'Rejected',
            ])
            ->default('pending')
            ->label('Status');

        CRUD::field('notes')
            ->type('textarea')
            ->label('Notes');
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
    }
}
