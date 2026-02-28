<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Closure;

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

        return [
            'class_time' => 'required',
            'driver_id' => [
                'required',
            ],
            'student_id' => [
                'required',
                'exists:users,id',
                Rule::unique('driver_student')
                    ->ignore($this->id) // 👈 ignore current record when editing
                    ->where(function ($query) {
                        return $query->whereDate('created_at', Carbon::today());
                    }),
            ],
            'class_start' => [
                'required',
                'date_format:Y-m-d H:i',
            ],
            'class_end' => [
                'required',
                'date_format:Y-m-d H:i',
                'after:class_start'
            ],
            'status' => 'required|in:pending,ongoing,completed,cancelled',
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
