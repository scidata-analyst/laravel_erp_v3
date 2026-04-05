<?php

namespace App\Http\Requests\HR;

use App\Traits\Validation\ValidationResponseTrait;
use App\Rules\HR\AttendanceStatusRule;
use App\Rules\Common\PaginationLimit;
use Illuminate\Foundation\Http\FormRequest;

class AttendanceRequest extends FormRequest
{
    use ValidationResponseTrait;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        if ($this->isMethod('get')) {
            return [
                'per_page' => ['nullable', new PaginationLimit],
                'employee_id' => 'nullable|integer|exists:employees,id',
                'status' => ['nullable', new AttendanceStatusRule]
            ];
        }

        return [
            'employee_id' => 'required|integer|exists:employees,id',
            'attendance_date' => 'required_without:date|date',
            'date' => 'required_without:attendance_date|date',
            'check_in' => 'nullable|date_format:H:i',
            'check_out' => 'nullable|date_format:H:i|after:check_in',
            'status' => ['nullable', new AttendanceStatusRule],
            'notes' => 'nullable|string',
        ];
    }
}
