<?php

namespace App\Http\Requests\HR;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for creating a new Employee record.
 */
class EmployeesStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'full_name' => ['required', 'string', 'max:255'],
            'employee_id' => ['required', 'string', 'max:50', 'unique:employees,employee_id'],
            'designation' => ['required', 'string', 'max:100'],
            'department' => ['required', 'string', 'max:100'],
            'basic_salary' => ['required', 'numeric', 'min:0'],
            'join_date' => ['required', 'date'],
            'contract_type' => ['required', 'string', 'max:50'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:50'],
            'status' => ['nullable', 'string', 'max:50'],
        ];
    }

    public function messages(): array
    {
        return [
            'full_name.required' => 'The full name is required.',
            'employee_id.required' => 'The employee ID is required.',
            'employee_id.unique' => 'The employee ID must be unique.',
            'designation.required' => 'The designation is required.',
            'department.required' => 'The department is required.',
            'basic_salary.required' => 'The basic salary is required.',
            'join_date.required' => 'The join date is required.',
            'contract_type.required' => 'The contract type is required.',
            'email.required' => 'The email is required.',
            'email.email' => 'Please enter a valid email address.',
            'phone.required' => 'The phone number is required.',
        ];
    }
}