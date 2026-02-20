<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return backpack_auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:5|max:255',
            'email' => 'required|email|unique:users,email,' . $this->route('id'),
            'password' => 'required|min:8',  // password is required on create, optional on update
            'dob' => 'required|date',
            'gender' => 'required|in:male,female,other',
            'role' => 'required|in:admin,driver,student',
            // 'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'profile_photo' => 'required|image',
            'present_address' => 'required|string|max:1000',
            'permanent_address' => 'required|string|max:1000',
            'father_name' => 'required|string|max:255',
            'mother_name' => 'nullable|string|max:255',
            'parent_contact' => 'required|string|max:255',
            'phone_number' => 'required|string|max:50',
            'nid_number' => 'nullable|string|max:50',
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            //
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            //
        ];
    }
}
