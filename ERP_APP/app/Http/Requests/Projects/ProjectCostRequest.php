<?php

namespace App\Http\Requests\Projects;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for validating Project Cost data.
 *
 * Validates fields based on the ProjectCost model fillable attributes:
 * - project_name: required, string, max 255
 * - cost_category: required, string, max 100
 * - amount: required, numeric, min 0
 * - date_incurred: required, date
 * - approved_by_user_id: nullable, exists in users table (foreign key relationship)
 * - description: nullable, string, max 500
 * - status: nullable, string, max 50
 */
class ProjectCostRequest extends FormRequest
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
        // Get the project cost ID for unique validation on updates
        $costId = $this->route('project_cost');

        return [
            // Project name: required, string, max 255 characters
            'project_name' => ['required', 'string', 'max:255'],

            // Cost category: required, string, max 100 characters (e.g., materials, labor, equipment)
            'cost_category' => ['required', 'string', 'max:100'],

            // Amount: required, numeric, must be 0 or greater
            'amount' => ['required', 'numeric', 'min:0'],

            // Date incurred: required, must be a valid date
            'date_incurred' => ['required', 'date'],

            // Approved by user: optional, must exist in users table
            'approved_by_user_id' => ['nullable', 'exists:App\Models\UsersRoles\User,id'],

            // Description: optional, string, max 500 characters
            'description' => ['nullable', 'string', 'max:500'],

            // Status: optional, string, max 50 characters (e.g., pending, approved, rejected)
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
            'project_name.required' => 'The project name is required.',
            'project_name.max' => 'Project name must not exceed 255 characters.',
            'cost_category.required' => 'The cost category is required.',
            'cost_category.max' => 'Cost category must not exceed 100 characters.',
            'amount.required' => 'The amount is required.',
            'amount.numeric' => 'Amount must be a numeric value.',
            'amount.min' => 'Amount must be at least 0.',
            'date_incurred.required' => 'The date incurred is required.',
            'date_incurred.date' => 'Please enter a valid date.',
            'approved_by_user_id.exists' => 'The selected user does not exist.',
            'description.max' => 'Description must not exceed 500 characters.',
            'status.max' => 'Status must not exceed 50 characters.',
        ];
    }
}
