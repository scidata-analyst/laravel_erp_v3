<?php

namespace App\Http\Requests\HR;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for validating Employee data.
 *
 * Validates fields based on the Employees model fillable attributes:
 * - full_name: required, string, max 255
 * - employee_id: required, string, unique in employees table
 * - designation: required, string, max 100
 * - department: required, string, max 100
 * - basic_salary: nullable, numeric, min 0
 * - join_date: required, date
 * - contract_type: nullable, string, max 50
 * - email: required, email, unique in employees table
 * - phone: nullable, string, max 20
 * - status: nullable, string, max 50
 */
class EmployeesRequest extends FormRequest
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
        // Get the employee ID for unique validation on updates
        $employeeId = $this->route('employee');

        return [
            // Full name: required, string, max 255 characters
            'full_name' => ['required', 'string', 'max:255'],

            // Employee ID: required, string, max 50 characters, unique in employees
            'employee_id' => [
                'required',
                'string',
                'max:50',
                "unique:employees,employee_id,{$employeeId},id",
            ],

            // Designation: required, string, max 100 characters
            'designation' => ['required', 'string', 'max:100'],

            // Department: required, string, max 100 characters
            'department' => ['required', 'string', 'max:100'],

            // Basic salary: optional, numeric, must be 0 or greater
            'basic_salary' => ['nullable', 'numeric', 'min:0'],

            // Join date: required, must be a valid date
            'join_date' => ['required', 'date'],

            // Contract type: optional, string, max 50 characters
            'contract_type' => ['nullable', 'string', 'max:50'],

            // Email: required, valid email format, unique in employees table
            'email' => [
                'required',
                'email',
                'max:255',
                "unique:employees,email,{$employeeId},id",
            ],

            // Phone: optional, string, max 20 characters
            'phone' => ['nullable', 'string', 'max:20'],

            // Status: optional, string, max 50 characters
            'status' => ['nullable', 'string', 'max:50'],
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
            'full_name.required' => 'The full name is required.',
            'full_name.max' => 'Full name must not exceed 255 characters.',
            'employee_id.required' => 'The employee ID is required.',
            'employee_id.max' => 'Employee ID must not exceed 50 characters.',
            'employee_id.unique' => 'This employee ID is already in use.',
            'designation.required' => 'The designation is required.',
            'designation.max' => 'Designation must not exceed 100 characters.',
            'department.required' => 'The department is required.',
            'department.max' => 'Department must not exceed 100 characters.',
            'basic_salary.numeric' => 'Basic salary must be a numeric value.',
            'basic_salary.min' => 'Basic salary must be at least 0.',
            'join_date.required' => 'The join date is required.',
            'join_date.date' => 'Please enter a valid date.',
            'contract_type.max' => 'Contract type must not exceed 50 characters.',
            'email.required' => 'The email address is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email address is already in use.',
            'phone.max' => 'Phone number must not exceed 20 characters.',
            'status.max' => 'Status must not exceed 50 characters.',
        ];
    }
}
