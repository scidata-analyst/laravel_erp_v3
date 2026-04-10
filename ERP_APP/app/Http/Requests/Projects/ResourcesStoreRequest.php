<?php

namespace App\Http\Requests\Projects;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for creating a new Resource Allocation record.
 */
class ResourcesStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'employee_id' => ['required', 'integer', 'exists:employees,id'],
            'project_name' => ['required', 'string', 'max:255'],
            'allocation_percentage' => ['required', 'numeric', 'min:0', 'max:100'],
            'from_date' => ['required', 'date'],
            'to_date' => ['required', 'date', 'after:from_date'],
            'role_on_project' => ['required', 'string', 'max:100'],
        ];
    }

    public function messages(): array
    {
        return [
            'employee_id.required' => 'The employee is required.',
            'employee_id.exists' => 'The selected employee is invalid.',
            'project_name.required' => 'The project name is required.',
            'allocation_percentage.required' => 'The allocation percentage is required.',
            'allocation_percentage.max' => 'Allocation cannot exceed 100%.',
            'from_date.required' => 'The start date is required.',
            'to_date.required' => 'The end date is required.',
            'to_date.after' => 'End date must be after start date.',
            'role_on_project.required' => 'The project role is required.',
        ];
    }
}