<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\DriverStudentRequest;
use App\Http\Requests\StudentDriverRequest;
use App\Models\StudentDriver;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Carbon\Carbon;

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

    protected function setupCreateOperation()
    {
        CRUD::setValidation(StudentDriverRequest::class);

        CRUD::field('car_type')
            ->type('select_from_array')
            ->label('Car Type')
            ->options([
                '' => '- Select Car Type -',
                'auto' => 'Auto',
                'manual' => 'Manual',
            ])->wrapper(['class' => 'form-group col-md-6']);

        CRUD::field('driver_id')
            ->type('select')
            ->label('Driver')
            ->options(function () {
                return \App\Models\User::where('role', 'driver')->get()->mapWithKeys(function ($u) {
                    $start = $u->start_date ? \Carbon\Carbon::parse($u->start_date)->format('Y-m-d H:i') : '-';
                    $end = $u->end_date ? \Carbon\Carbon::parse($u->end_date)->format('Y-m-d H:i') : '-';
                    return [$u->id => $u->name . ' (' . $start . ' - ' . $end . ')'];
                })->toArray();
            })->wrapper(['class' => 'form-group col-md-6']);

        // CRUD::field('student_id')
        //     ->type('select')
        //     ->label('Student')
        //     ->options(function () {
        //         $user = backpack_user();
        //         if ($user->role === 'student') {
        //             return \App\Models\User::where(['role' => 'student', 'id' => $user->id])->pluck('name', 'id');
        //         } elseif ($user->role === 'admin') {
        //             return \App\Models\User::where('role', 'student')->pluck('name', 'id');
        //         }
        //     });

        $user = backpack_user();

        if ($user->role === 'admin') {
            // Admin sees the select dropdown
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
                ->default(null)->wrapper(['class' => 'form-group col-md-6']);
        } else {
            // Student: hidden field with their own ID
            CRUD::field('student_id')
                ->type('hidden')
                ->default($user->id);
        }

        // Assignment date - ensure one student can have one driver per date
        // 1️⃣ Next Date & Time field
        CRUD::field('next_date')
            ->type('text')
            ->label('Next Date & Time')
            ->default(Carbon::tomorrow()->format('Y-m-d H:00'))
            ->attributes([
                'id' => 'next_datetime_picker',
                'autocomplete' => 'off',
                'placeholder' => 'Select date & time (tomorrow, 12AM - 11PM)',
            ])
            ->wrapper(['class' => 'form-group col-md-6']);

        CRUD::field('number_of_class')
            ->type('number')
            ->label('Number of Class')
            ->attributes([
                'min' => 1,
                'max' => 5,
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
        ]);

        $this->crud->addField([
            'name' => 'flatpickr_script',
            'type' => 'custom_html',
            'value' => '<script>
            document.addEventListener("DOMContentLoaded", function () {
                flatpickr("#next_datetime_picker", {
                    enableTime: true,
                    noCalendar: false,
                    dateFormat: "Y-m-d h:i K", // 12-hour with AM/PM
                    defaultDate: "' . Carbon::tomorrow()->format('Y-m-d h:00 A') . '",
                    minDate: "' . Carbon::tomorrow()->format('Y-m-d') . '", // only tomorrow selectable
                    maxDate: "' . Carbon::tomorrow()->format('Y-m-d') . '",
                    minTime: "12:00 AM",
                    maxTime: "11:00 PM",
                    time_24hr: false, // 12-hour format
                    minuteIncrement: 60,
                    allowInput: true
                });
            });
            </script>',
        ]);

        // $user = backpack_user();
        // $statusOptions = ($user && $user->role === 'student')
        //     ? [
        //         'pending' => 'Pending',
        //     ]
        //     : [
        //         'pending' => 'Pending',
        //         'accepted' => 'Accepted',
        //         'rejected' => 'Rejected',
        //     ];

        // CRUD::field('status')
        //     ->type('select_from_array')
        //     ->options($statusOptions)
        //     ->default('pending')
        //     ->label('Status');

        // CRUD::field('notes')
        //     ->type('textarea')
        //     ->label('Notes');
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
