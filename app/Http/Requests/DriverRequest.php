<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DriverRequest extends FormRequest
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
            'password' => 'required|min:8',
            'dob' => 'required|date',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'gender' => 'required|in:male,female,other',
            'role' => 'required|in:admin,driver,student',
            'student_capacity' => 'required|integer|min:1',
            // 'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'profile_photo' => 'required|image',
            'present_address' => 'required|string|max:1000',
            'permanent_address' => 'required|string|max:1000',
            'phone_number' => 'required|string|max:50',
            'nid_number' => 'required|string|max:50',
            'father_name' => 'nullable|string|max:255',
            'mother_name' => 'nullable|string|max:255',
            'parent_contact' => 'nullable|string|max:255'
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
