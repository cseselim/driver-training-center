<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StudentDriverRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $entryId = $this->route('id');
        $uniqueRule = Rule::unique('student_driver')->where(function ($query) {
            return $query->where('next_date', $this->input('next_date'));
        });

        // For update requests, ignore the current entry
        if ($entryId) {
            $uniqueRule = $uniqueRule->ignore($entryId);
        }

        return [
            'student_id' => [
                'required',
                'exists:users,id',
                $uniqueRule,
            ],
            'driver_id' => 'required|exists:users,id',
            'car_type' => 'required|in:auto,manual',
            'next_date' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    $dt = Carbon::parse($value);

                    // Must be tomorrow
                    if (!$dt->isSameDay(Carbon::tomorrow())) {
                        $fail('The ' . $attribute . ' must be tomorrow.');
                    }

                    // Must be between 12 AM and 11 PM
                    $hour = $dt->hour;
                    if ($hour < 0 || $hour > 23) {
                        $fail('The ' . $attribute . ' time must be between 12 AM and 11 PM.');
                    }
                }
            ],
            'number_of_class' => 'required|integer|min:1|max:5',
        ];
    }
}
