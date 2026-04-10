<?php

namespace App\Http\Requests\Projects;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for creating a new Project Cost record.
 */
class ProjectCostStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'project_name' => ['required', 'string', 'max:255'],
            'cost_category' => ['required', 'string', 'max:100'],
            'amount' => ['required', 'numeric', 'min:0'],
            'date_incurred' => ['required', 'date'],
            'approved_by_user_id' => ['nullable', 'integer'],
            'description' => ['nullable', 'string'],
            'status' => ['nullable', 'string', 'max:50'],
        ];
    }

    public function messages(): array
    {
        return [
            'project_name.required' => 'The project name is required.',
            'cost_category.required' => 'The cost category is required.',
            'amount.required' => 'The amount is required.',
            'amount.numeric' => 'Amount must be a numeric value.',
            'date_incurred.required' => 'The date incurred is required.',
        ];
    }
}