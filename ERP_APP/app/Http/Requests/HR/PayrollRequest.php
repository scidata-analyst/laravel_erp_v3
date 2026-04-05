<?php

namespace App\Http\Requests\HR;

use App\Traits\Validation\ValidationResponseTrait;
use App\Rules\HR\PaymentMethodRule;
use App\Rules\Common\PaginationLimit;
use Illuminate\Foundation\Http\FormRequest;

class PayrollRequest extends FormRequest
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
                'payment_method' => ['nullable', new PaymentMethodRule]
            ];
        }

        return [
            'employee_id' => 'required|integer|exists:employees,id',
            'pay_period' => 'nullable|string|max:255',
            'period_start' => 'nullable|date',
            'period_end' => 'nullable|date|after_or_equal:period_start',
            'basic_salary' => 'required_without:salary|numeric|min:0',
            'salary' => 'required_without:basic_salary|numeric|min:0',
            'overtime_hours' => 'nullable|numeric|min:0',
            'overtime_rate' => 'nullable|numeric|min:0',
            'bonus' => 'nullable|numeric|min:0',
            'deductions' => 'nullable',
            'net_pay' => 'nullable|numeric|min:0',
            'net_salary' => 'nullable|numeric|min:0',
            'pay_date' => 'nullable|date',
            'payment_date' => 'nullable|date',
            'payment_method' => ['nullable', new PaymentMethodRule],
            'status' => 'nullable|string|max:50',
        ];
    }
}
