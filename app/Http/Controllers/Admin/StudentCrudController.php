<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StudentRequest;
use App\Models\Course;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Backpack\CRUD\app\Library\Widget;

/**
 * Class StudentCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class StudentCrudController extends CrudController
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
        CRUD::setRoute(config('backpack.base.route_prefix') . '/student');
        CRUD::setEntityNameStrings('student', 'students');
        CRUD::addClause('where', 'role', '=', 'student');
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
        CRUD::column('phone_number')->label('Phone Number');
        CRUD::column('nid_number')->label('NID Number');
        CRUD::column('father_name')->label("Father's Name");
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
        CRUD::setValidation(StudentRequest::class);

        CRUD::field('name')->label('Full Name')->wrapper(['class' => 'form-group col-md-6']);
        CRUD::field('email')->label('Email')->wrapper(['class' => 'form-group col-md-6']);
        CRUD::field('phone_number')->label("Mobile Number")->wrapper(['class' => 'form-group col-md-6']);
        CRUD::field('dob')->type('date')->label('Date of Birth')->wrapper(['class' => 'form-group col-md-6']);

        // Course dropdown (not a foreign key)
        $this->crud->addField([
            'name' => 'course_id',
            'type' => 'select_from_array',
            'label' => 'Course',
            'options' => Course::pluck('course_name', 'id')->toArray(),
            'attributes' => ['id' => 'course_id'],
            'wrapper' => [
                'class' => 'form-group col-md-6'
            ],
        ]);

        // Add after_scripts for JS
        $this->crud->addField([
            'name' => 'course_script',
            'type' => 'custom_html',
            'value' => '<script>
            document.addEventListener("DOMContentLoaded", function() {
                let courseSelect = document.getElementById("course_id");
                if (!courseSelect) return;

                let wrappers = [
                    document.querySelector("[name=course_name]").closest(".form-group"),
                    document.querySelector("[name=regular_course_fee]").closest(".form-group"),
                    document.querySelector("[name=actual_course_fee]").closest(".form-group"),
                    document.querySelector("[name=total_class]").closest(".form-group"),
                    document.querySelector("[name=per_class_duration]").closest(".form-group"),
                    document.querySelector("[name=total_duration]").closest(".form-group"),
                ];

                function hideFields(){
                    wrappers.forEach(w => {
                        w.style.display = "none";
                        w.querySelector("input").value = "";
                    });
                }

                function showFields(){
                    wrappers.forEach(w => w.style.display = "");
                }

                function loadCourse(id){
                    if(!id){ hideFields(); return; }
                    fetch("/admin/course-details/" + id)
                        .then(res => res.json())
                        .then(data => {
                        document.querySelector("[name=course_name]").value = courseSelect.options[courseSelect.selectedIndex].text || "";
                            document.querySelector("[name=regular_course_fee]").value = data.regular_course_fee ?? "";
                            document.querySelector("[name=actual_course_fee]").value = data.actual_course_fee ?? "";
                            document.querySelector("[name=total_class]").value = data.total_class ?? "";
                            document.querySelector("[name=per_class_duration]").value = data.per_class_duration ?? "";
                            document.querySelector("[name=total_duration]").value = data.total_duration ?? "";
                            showFields();
                        });
                }

                courseSelect.addEventListener("change", function(){ loadCourse(this.value); });

                if(courseSelect.value) loadCourse(courseSelect.value);
                else hideFields();
            });
        </script>',
            'wrapper' => [
                'class' => 'd-none'
            ],
        ]);

        // Regular course fields
        CRUD::field('course_name')
            ->type('text')->wrapper(['class' => 'form-group col-md-6']);

        CRUD::field('regular_course_fee')
            ->type('number')->wrapper(['class' => 'form-group col-md-6']);

        CRUD::field('actual_course_fee')
            ->type('number')->wrapper(['class' => 'form-group col-md-6']);

        CRUD::field('total_class')
            ->type('number')->wrapper(['class' => 'form-group col-md-6']);

        CRUD::field('per_class_duration')
            ->type('number')->wrapper(['class' => 'form-group col-md-6']);

        CRUD::field('total_duration')
            ->type('number')->wrapper(['class' => 'form-group col-md-6']);

        CRUD::field('present_address')->label('Present Address')->wrapper(['class' => 'form-group col-md-6']);
        CRUD::field('permanent_address')->label('Permanent Address')->wrapper(['class' => 'form-group col-md-6']);

        CRUD::field('gender')
            ->type('select_from_array')
            ->options([
                'male' => 'Male',
                'female' => 'Female',
                'other' => 'Other',
            ])
            ->label('Gender')->wrapper(['class' => 'form-group col-md-6']);

        CRUD::field('father_name')->label("Father's Name")->wrapper(['class' => 'form-group col-md-6']);
        CRUD::field('mother_name')->label("Mother's Name")->wrapper(['class' => 'form-group col-md-6']);
        CRUD::field('parent_contact')->label("Emergency Contact Person Mobile Number")->wrapper(['class' => 'form-group col-md-6']);
        CRUD::field('emergency_contact_relation')->label("Emergency Contact Person Relation")->wrapper(['class' => 'form-group col-md-6']);
        CRUD::field("nid_number")->label("NID Number")->wrapper(['class' => 'form-group col-md-6']);

        CRUD::field('role')
            ->type('hidden')
            ->default('student');

        CRUD::field('password')
            ->type('password')
            ->label('Password')->wrapper(['class' => 'form-group col-md-6']);

        // ✅ Correctly configured status field
        CRUD::field('status')
            ->type('select_from_array')
            ->options([
                1 => 'Active',
                2 => 'Incomplete',
                3 => 'Inactive',
                9 => 'Dropped Out',
            ])
            ->default(1)
            ->allows_null(false)
            ->label('Status')->wrapper(['class' => 'form-group col-md-6']);

        CRUD::field('remarks')->label('Remarks')->wrapper(['class' => 'form-group col-md-6']);

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
