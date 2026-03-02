<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\DriverRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class DriverCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class DriverCrudController extends CrudController
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
        CRUD::setModel(\App\Models\User::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/driver');
        CRUD::setEntityNameStrings('driver', 'Instructor');
        CRUD::addClause('where', 'role', '=', 'driver');
        CRUD::setEntityNameStrings('Instructor', 'Instructors');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        //CRUD::setFromDb(); // columns
        /**
         * Columns can be defined using the fluent syntax:
         * - CRUD::column('price')->type('number');
         */
        CRUD::column('name')->label('Full Name');
        CRUD::column('email')->label('Email');
        CRUD::column('gender')->label('Gender');
        CRUD::column('phone_number')->label('Mobile Number');
        CRUD::column('parent_contact')->label('Emergency Contact Person');
        CRUD::column('nid_number')->label('NID Number');
        // CRUD::addColumn([
        //     'name'  => 'profile_photo',
        //     'label' => 'Photo',
        //     'type'  => 'custom_html',
        //     'value' => function ($entry) {
        //         if (!$entry->profile_photo) {
        //             return '-';
        //         }

        //         return '<img src="'.asset('storage/'.$entry->profile_photo).'"
        //                     style="width:60px; height:60px; object-fit:cover; border-radius:6px;">';
        //     },
        // ]);
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(DriverRequest::class);

        CRUD::field('name')
            ->label('Full Name')
            ->wrapper(['class' => 'form-group col-md-6']);

        CRUD::field('email')
            ->label('Email')
            ->wrapper(['class' => 'form-group col-md-6']);

        CRUD::field('phone_number')
            ->label("Mobile Number")
            ->wrapper(['class' => 'form-group col-md-6']);

        // Availability window
        // CRUD::field('start_date')->type('datetime')->label('Start Date');
        // CRUD::field('end_date')->type('datetime')->label('End Date');
        // CRUD::field('student_capacity')->type('number')->label('Student Capacity');

        // Date of Birth
        CRUD::field('dob')->type('date')
            ->label('Date of Birth')
            ->wrapper(['class' => 'form-group col-md-6']);

        // Address
        CRUD::field('present_address')
            ->label('Present Address')
            ->wrapper(['class' => 'form-group col-md-6']);

        CRUD::field('permanent_address')
            ->label('Permanent Address')
            ->wrapper(['class' => 'form-group col-md-6']);

        // Gender dropdown
        CRUD::field('gender')
            ->type('select_from_array')
            ->options([
                'male' => 'Male',
                'female' => 'Female',
                'other' => 'Other',
            ])
            ->label('Gender')
            ->wrapper(['class' => 'form-group col-md-6']);

        // Parent info
        CRUD::field('father_name')
            ->label("Father's Name")
            ->wrapper(['class' => 'form-group col-md-6']);
        CRUD::field('mother_name')
            ->label("Mother's Name")
            ->wrapper(['class' => 'form-group col-md-6']);
        CRUD::field('parent_contact')
            ->label("Emergency Contact Person Mobile Number")
            ->wrapper(['class' => 'form-group col-md-6']);
        CRUD::field('emergency_contact_relation')
            ->label("Emergency Contact Person Relation")
            ->wrapper(['class' => 'form-group col-md-6']);

        CRUD::field("nid_number")
            ->label("NID Number")
            ->wrapper(['class' => 'form-group col-md-6']);

        CRUD::field('password')
            ->type('password')
            ->label('Password')
            ->wrapper(['class' => 'form-group col-md-6']);

        // Profile photo
        CRUD::field('profile_photo')
            ->type('upload')
            ->upload(true)
            ->disk('public')
            ->wrapper(['class' => 'form-group col-md-6']);

        // Role dropdown
        CRUD::field('role')
            ->type('hidden')
            ->default('driver')
            ->wrapper(['class' => 'form-group col-md-6']);

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
