<?php

namespace App\Http\Requests\HR;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for updating an existing Attendance record.
 */
class AttendanceUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'employee_id' => ['sometimes', 'integer', 'exists:employees,id'],
            'attendance_date' => ['sometimes', 'date'],
            'check_in_time' => ['nullable', 'date_format:H:i:s'],
            'check_out_time' => ['nullable', 'date_format:H:i:s'],
            'status' => ['nullable', 'string', 'max:50'],
            'leave_type' => ['nullable', 'string', 'max:50'],
        ];
    }

    public function messages(): array
    {
        return [
            'employee_id.exists' => 'The selected employee is invalid.',
            'check_in_time.date_format' => 'Check-in time must be in HH:MM:SS format.',
            'check_out_time.date_format' => 'Check-out time must be in HH:MM:SS format.',
        ];
    }
}