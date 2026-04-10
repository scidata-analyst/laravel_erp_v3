<?php

namespace App\Http\Requests\Projects;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for validating Project Resource data.
 *
 * Validates fields based on the Resources model fillable attributes:
 * - employee_id: required, exists in employees table (foreign key relationship)
 * - project_name: required, string, max 255
 * - allocation_percentage: required, numeric, between 0 and 100
 * - from_date: required, date
 * - to_date: required, date, must be after from_date
 * - role_on_project: nullable, string, max 100
 */
class ResourcesRequest extends FormRequest
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
        // Get the resource ID for unique validation on updates
        $resourceId = $this->route('resource');

        return [
            // Employee: required, must exist in employees table
            'employee_id' => ['required', 'exists:App\Models\HR\Employees,id'],

            // Project name: required, string, max 255 characters
            'project_name' => ['required', 'string', 'max:255'],

            // Allocation percentage: required, numeric, between 0 and 100
            'allocation_percentage' => ['required', 'numeric', 'min:0', 'max:100'],

            // From date: required, must be a valid date
            'from_date' => ['required', 'date'],

            // To date: required, must be a valid date after from_date
            'to_date' => ['required', 'date', 'after:from_date'],

            // Role on project: optional, string, max 100 characters
            'role_on_project' => ['nullable', 'string', 'max:100'],
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
            'project_name.required' => 'The project name is required.',
            'project_name.max' => 'Project name must not exceed 255 characters.',
            'allocation_percentage.required' => 'The allocation percentage is required.',
            'allocation_percentage.numeric' => 'Allocation percentage must be a numeric value.',
            'allocation_percentage.min' => 'Allocation percentage must be at least 0.',
            'allocation_percentage.max' => 'Allocation percentage must not exceed 100.',
            'from_date.required' => 'The from date is required.',
            'from_date.date' => 'Please enter a valid date.',
            'to_date.required' => 'The to date is required.',
            'to_date.date' => 'Please enter a valid date.',
            'to_date.after' => 'To date must be after the from date.',
            'role_on_project.max' => 'Role on project must not exceed 100 characters.',
        ];
    }
}
