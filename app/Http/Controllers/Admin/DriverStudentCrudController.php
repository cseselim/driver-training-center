<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\DriverStudentRequest;
use App\Models\DriverStudent;
use App\Models\StudentDriver;
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
        CRUD::setEntityNameStrings('class', 'classes');

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
            ->label('Instructor')
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

        // CRUD::column('status')
        //     ->label('Status')
        //     ->type('select_from_array')
        //     ->options([
        //         'pending' => 'Pending',
        //         'accepted' => 'Accepted',
        //         'rejected' => 'Rejected',
        //     ]);

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
        $user = backpack_user();
        if ($user->role === 'admin') {
            CRUD::field('driver_id')
                ->type('select')
                ->label('Instructor')
                ->options(function () {
                    return \App\Models\User::where('role', 'driver')
                        ->get()
                        ->pluck(function ($u) {
                            return $u->name . ' (' . $u->phone_number . ')';
                        }, 'id')
                        ->toArray();
                })
                ->wrapper([
                    'class' => 'form-group col-md-6'
                ]);
        } else {
            // Student: hidden field with their own ID
            CRUD::field('driver_id')
                ->type('hidden')
                ->default($user->id);
        }

        CRUD::field('student_id')
            ->type('select')
            ->label('Student')
            ->options(function () {
                return \App\Models\User::where('role', 'student')->pluck('name', 'id');
            })->wrapper(['class' => 'form-group col-md-6']);

        CRUD::field('student_id')
            ->type('select')
            ->label('Student')
            ->options(function () {
                return \App\Models\User::where('role', 'student')
                    ->get()
                    ->pluck(function ($user) {
                        return $user->name . ' (' . $user->phone_number . ')';
                    }, 'id')
                    ->toArray();
            })
            ->allows_null(false)
            ->wrapper(['class' => 'form-group col-md-6']);

        CRUD::field('class_time')
            ->type('select_from_array')
            ->options([
                'A/D' => 'A/D',
                'A/N' => 'A/N',
                'M/D' => 'M/D',
                'M/N' => 'M/N',
            ])
            ->default('A/D')
            ->label('Class Time')->wrapper(['class' => 'form-group col-md-6']);

        CRUD::field('class_start')
            ->type('text')
            ->label('Class Start')
            ->attributes([
                'id' => 'class_start_picker',
                'autocomplete' => 'off',
            ])
            ->wrapper(['class' => 'form-group col-md-6']);

        $this->crud->addField([
            'name' => 'flatpickr_assets',
            'type' => 'custom_html',
            'value' => '
            <!-- Flatpickr CSS -->
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
            <!-- Flatpickr JS -->
            <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>',
            'wrapper' => [
                'class' => 'd-none'
            ],
        ]);

        $this->crud->addField([
            'name' => 'class_start_script',
            'type' => 'custom_html',
            'value' => '<script>
            document.addEventListener("DOMContentLoaded", function () {
                flatpickr("#class_start_picker", {
                    enableTime: true,
                    noCalendar: false,
                    dateFormat: "Y-m-d H:i", // Saved format (24-hour)
                    altInput: true,
                    altFormat: "F j, Y h:i K", // Display format (AM/PM)
                    time_24hr: true,
                    minuteIncrement: 60,
                    minDate: "today"
                });
            });
        </script>',
            'wrapper' => [
                'class' => 'd-none'
            ],
        ]);

        CRUD::field('class_end')
            ->type('text')
            ->label('Class End')
            ->attributes([
                'id' => 'class_end_picker',
                'autocomplete' => 'off',
            ])
            ->wrapper(['class' => 'form-group col-md-6']);

        $this->crud->addField([
            'name' => 'class_end_script',
            'type' => 'custom_html',
            'value' => '<script>
            document.addEventListener("DOMContentLoaded", function () {
                flatpickr("#class_end_picker", {
                    enableTime: true,
                    noCalendar: false,
                    dateFormat: "Y-m-d H:i", // Saved format (24-hour)
                    altInput: true,
                    altFormat: "F j, Y h:i K", // Display format (AM/PM)
                    time_24hr: true,
                    minuteIncrement: 60,
                    minDate: "today"
                });
            });
        </script>',
            'wrapper' => [
                'class' => 'd-none'
            ],
        ]);

        CRUD::field('class_type')
            ->type('select_from_array')
            ->label('Class Type')
            ->options([
                'drive' => 'Drive',
                'zigzag' => 'Zigzag',
                'parking' => 'Parking',
                'back_gearing' => 'Back Gearing',
            ])->default('drive')
            ->wrapper(['class' => 'form-group col-md-6']);

        CRUD::field('Remarks')
            ->type('textarea')
            ->label('Remarks')->wrapper(['class' => 'form-group col-md-6']);

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
