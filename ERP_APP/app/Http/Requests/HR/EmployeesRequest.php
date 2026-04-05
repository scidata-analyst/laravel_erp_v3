<?php

namespace App\Http\Requests\HR;

use App\Traits\Validation\ValidationResponseTrait;
use App\Rules\HR\EmployeeStatusRule;
use App\Rules\Common\PaginationLimit;
use Illuminate\Foundation\Http\FormRequest;

class EmployeesRequest extends FormRequest
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
                'search' => 'nullable|string|max:255',
                'department_id' => 'nullable|exists:departments,id',
                'status' => ['nullable', new EmployeeStatusRule]
            ];
        }

        return [
            'full_name' => 'required_without:name|string|max:255',
            'name' => 'required_without:full_name|string|max:255',
            'employee_code' => 'required_without:employee_id|string|max:100',
            'employee_id' => 'required_without:employee_code|string|max:100',
            'email' => 'required|email|unique:employees,email,' . $this->route('employee'),
            'phone' => 'required|string|max:20',
            'join_date' => 'required_without:hire_date|date',
            'hire_date' => 'required_without:join_date|date',
            'position' => 'required_without:job_title|string|max:100',
            'job_title' => 'required_without:position|string|max:100',
            'department' => 'required_without:department_id|string|max:255',
            'department_id' => 'nullable|exists:departments,id',
            'basic_salary' => 'required_without:salary|numeric|min:0',
            'salary' => 'required_without:basic_salary|numeric|min:0',
            'address' => 'nullable|string|max:1000',
            'contract_type' => 'nullable|string|max:100',
            'manager_id' => 'nullable|exists:employees,id',
            'status' => ['required', new EmployeeStatusRule]
        ];
    }
}
