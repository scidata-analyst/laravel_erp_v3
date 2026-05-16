<?php

namespace App\Http\Requests\HR;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for creating a new Payroll record.
 */
class PayrollStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'employee_id' => ['required', 'integer', 'exists:employees,id'],
            'payroll_period' => ['required', 'string', 'max:50'],
            'basic_salary' => ['required', 'numeric', 'min:0'],
            'allowances' => ['nullable', 'numeric', 'min:0'],
            'deductions' => ['nullable', 'numeric', 'min:0'],
            'net_pay' => ['required', 'numeric', 'min:0'],
            'status' => ['nullable', 'string', 'max:50'],
        ];
    }

    public function messages(): array
    {
        return [
            'employee_id.required' => 'The employee is required.',
            'employee_id.exists' => 'The selected employee is invalid.',
            'payroll_period.required' => 'The payroll period is required.',
            'basic_salary.required' => 'The basic salary is required.',
            'net_pay.required' => 'The net pay is required.',
        ];
    }
}