<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AdminRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class AdminCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class AdminCrudController extends CrudController
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
        CRUD::setRoute(config('backpack.base.route_prefix') . '/admin');
        CRUD::setEntityNameStrings('admin', 'admins');
        CRUD::addClause('where', 'role', '=', 'admin');
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
        CRUD::column('dob')->label('Date of Birth');
        CRUD::column('gender')->label('Gender');
        CRUD::column('role')->label('Role');
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
        CRUD::setValidation(AdminRequest::class);

        CRUD::field('name')->label('Full Name');
        CRUD::field('email')->label('Email');

        // Date of Birth
        CRUD::field('dob')->type('date')->label('Date of Birth');

        // Address
        CRUD::field('present_address')->label('Present Address');
        CRUD::field('permanent_address')->label('Permanent Address');

        // Gender dropdown
        CRUD::field('gender')
            ->type('select_from_array')
            ->options([
                'male' => 'Male',
                'female' => 'Female',
                'other' => 'Other',
            ])
            ->label('Gender');

        // Parent info
        CRUD::field('father_name')->label("Father's Name");
        CRUD::field('mother_name')->label("Mother's Name");
        CRUD::field('parent_contact')->label("Parent Contact");

        // Role dropdown
        CRUD::field('role')
            ->type('hidden')
            ->default('admin');

        CRUD::field('password')
            ->type('password')
            ->label('Password');

        // Profile photo
        CRUD::field('profile_photo')
            ->type('upload')
            ->upload(true)
            ->disk('public')
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
