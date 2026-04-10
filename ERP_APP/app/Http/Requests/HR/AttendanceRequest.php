<?php

namespace App\Http\Requests\HR;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for validating Attendance data.
 *
 * Validates fields based on the Attendance model fillable attributes:
 * - employee_id: required, exists in employees table (foreign key relationship)
 * - attendance_date: required, date
 * - check_in_time: nullable, date_format:H:i
 * - check_out_time: nullable, date_format:H:i, after check_in_time
 * - status: required, string, max 50
 * - leave_type: nullable, string, max 50
 */
class AttendanceRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // Get the attendance ID for unique validation on updates
        $attendanceId = $this->route('attendance');

        return [
            // Employee: required, must exist in employees table
            'employee_id' => ['required', 'exists:App\Models\HR\Employees,id'],

            // Attendance date: required, must be a valid date
            'attendance_date' => [
                'required',
                'date',
            ],

            // Check-in time: optional, must be in time format (HH:MM)
            'check_in_time' => ['nullable', 'date_format:H:i'],

            // Check-out time: optional, must be in time format (HH:MM), after check-in
            'check_out_time' => ['nullable', 'date_format:H:i', 'after:check_in_time'],

            // Status: required, string, max 50 characters
            'status' => ['required', 'string', 'max:50'],

            // Leave type: optional, string, max 50 characters
            'leave_type' => ['nullable', 'string', 'max:50'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'employee_id.required' => 'Please select an employee.',
            'employee_id.exists' => 'The selected employee does not exist.',
            'attendance_date.required' => 'The attendance date is required.',
            'attendance_date.date' => 'Please enter a valid date.',
            'attendance_date.unique' => 'Attendance record for this date already exists.',
            'check_in_time.date_format' => 'Check-in time must be in HH:MM format.',
            'check_out_time.date_format' => 'Check-out time must be in HH:MM format.',
            'check_out_time.after' => 'Check-out time must be after check-in time.',
            'status.required' => 'The attendance status is required.',
            'status.max' => 'Status must not exceed 50 characters.',
            'leave_type.max' => 'Leave type must not exceed 50 characters.',
        ];
    }
}
