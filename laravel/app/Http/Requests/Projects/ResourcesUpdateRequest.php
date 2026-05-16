<?php

namespace App\Http\Requests\Projects;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for updating an existing Resource Allocation record.
 */
class ResourcesUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'employee_id' => ['sometimes', 'integer', 'exists:employees,id'],
            'project_name' => ['sometimes', 'string', 'max:255'],
            'allocation_percentage' => ['sometimes', 'numeric', 'min:0', 'max:100'],
            'from_date' => ['sometimes', 'date'],
            'to_date' => ['sometimes', 'date'],
            'role_on_project' => ['sometimes', 'string', 'max:100'],
        ];
    }

    public function messages(): array
    {
        return [
            'employee_id.exists' => 'The selected employee is invalid.',
            'allocation_percentage.max' => 'Allocation cannot exceed 100%.',
            'to_date.after' => 'End date must be after start date.',
        ];
    }
}