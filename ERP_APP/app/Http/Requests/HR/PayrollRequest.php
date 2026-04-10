<?php

namespace App\Http\Requests\HR;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for validating Payroll data.
 *
 * Validates fields based on the Payroll model fillable attributes:
 * - employee_id: required, exists in employees table (foreign key relationship)
 * - payroll_period: required, string, max 50
 * - basic_salary: required, numeric, min 0
 * - allowances: nullable, numeric, min 0
 * - deductions: nullable, numeric, min 0
 * - net_pay: required, numeric, min 0
 * - status: nullable, string, max 50
 */
class PayrollRequest extends FormRequest
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
        // Get the payroll ID for unique validation on updates
        $payrollId = $this->route('payroll');

        return [
            // Employee: required, must exist in employees table
            'employee_id' => ['required', 'exists:App\Models\HR\Employees,id'],

            // Payroll period: required, string, max 50 characters (e.g., "2024-01" for January 2024)
            'payroll_period' => [
                'required',
                'string',
                'max:50',
            ],

            // Basic salary: required, numeric, must be 0 or greater
            'basic_salary' => ['required', 'numeric', 'min:0'],

            // Allowances: optional, numeric, must be 0 or greater
            'allowances' => ['nullable', 'numeric', 'min:0'],

            // Deductions: optional, numeric, must be 0 or greater
            'deductions' => ['nullable', 'numeric', 'min:0'],

            // Net pay: required, numeric, must be 0 or greater
            'net_pay' => ['required', 'numeric', 'min:0'],

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
            'employee_id.required' => 'Please select an employee.',
            'employee_id.exists' => 'The selected employee does not exist.',
            'payroll_period.required' => 'The payroll period is required.',
            'payroll_period.max' => 'Payroll period must not exceed 50 characters.',
            'basic_salary.required' => 'The basic salary is required.',
            'basic_salary.numeric' => 'Basic salary must be a numeric value.',
            'basic_salary.min' => 'Basic salary must be at least 0.',
            'allowances.numeric' => 'Allowances must be a numeric value.',
            'allowances.min' => 'Allowances must be at least 0.',
            'deductions.numeric' => 'Deductions must be a numeric value.',
            'deductions.min' => 'Deductions must be at least 0.',
            'net_pay.required' => 'The net pay is required.',
            'net_pay.numeric' => 'Net pay must be a numeric value.',
            'net_pay.min' => 'Net pay must be at least 0.',
            'status.max' => 'Status must not exceed 50 characters.',
        ];
    }
}
