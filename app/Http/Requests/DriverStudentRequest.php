<?php

namespace App\Http\Requests;

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
        $entryId = $this->route('id');
        $uniqueRule = Rule::unique('driver_student')->where(function ($query) {
            return $query->where('assignment_date', $this->input('assignment_date'));
        });

        // For update requests, ignore the current entry
        if ($entryId) {
            $uniqueRule = $uniqueRule->ignore($entryId);
        }

        return [
            'driver_id' => [
                'required',
                'exists:users,id',
                function (string $attribute, mixed $value, Closure $fail) use ($entryId) {
                    // Check if driver has reached student_capacity for the given assignment date
                    $driver = \App\Models\User::find($value);
                    if (!$driver || !$driver->student_capacity) {
                        return; // No capacity limit
                    }

                    $query = \App\Models\DriverStudent::where('driver_id', $value)
                        ->where('assignment_date', $this->input('assignment_date'));

                    // Exclude current entry if updating
                    if ($entryId) {
                        $query = $query->where('id', '!=', $entryId);
                    }

                    $assignedCount = $query->count();
                    if ($assignedCount >= $driver->student_capacity) {
                        $fail("Driver {$driver->name} has reached their student capacity of {$driver->student_capacity} for the chosen date.");
                    }
                },
            ],
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
