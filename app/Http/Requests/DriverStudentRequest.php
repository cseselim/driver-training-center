<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DriverStudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return backpack_auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $entryId = $this->route('id');
        $uniqueRule = Rule::unique('driver_student')->where(function ($query) {
            return $query->where('assignment_date', $this->input('assignment_date'));
        });

        // For update requests, ignore the current entry
        if ($entryId) {
            $uniqueRule = $uniqueRule->ignore($entryId);
        }

        return [
            'driver_id' => 'required|exists:users,id',
            'assignment_date' => 'required|date',
            'student_id' => [
                'required',
                'exists:users,id',
                $uniqueRule,
            ],
            'status' => 'required|in:pending,done,rejected',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'student_id.unique' => 'This student is already scheduled with a driver for the chosen day. Please select a different date or student.',
        ];
    }
}
