<?php

namespace App\Http\Requests\HR;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for updating an existing Employee record.
 */
class EmployeesUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $employeeId = $this->route('employee');
        return [
            'full_name' => ['sometimes', 'string', 'max:255'],
            'employee_id' => ['sometimes', 'string', 'max:50', 'unique:employees,employee_id,' . $employeeId],
            'designation' => ['sometimes', 'string', 'max:100'],
            'department' => ['sometimes', 'string', 'max:100'],
            'basic_salary' => ['sometimes', 'numeric', 'min:0'],
            'join_date' => ['sometimes', 'date'],
            'contract_type' => ['sometimes', 'string', 'max:50'],
            'email' => ['sometimes', 'email', 'max:255'],
            'phone' => ['sometimes', 'string', 'max:50'],
            'status' => ['nullable', 'string', 'max:50'],
        ];
    }

    public function messages(): array
    {
        return [
            'employee_id.unique' => 'The employee ID must be unique.',
            'email.email' => 'Please enter a valid email address.',
        ];
    }
}