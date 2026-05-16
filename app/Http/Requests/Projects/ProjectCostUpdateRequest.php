<?php

namespace App\Http\Requests\Projects;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for updating an existing Project Cost record.
 */
class ProjectCostUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'project_name' => ['sometimes', 'string', 'max:255'],
            'cost_category' => ['sometimes', 'string', 'max:100'],
            'amount' => ['sometimes', 'numeric', 'min:0'],
            'date_incurred' => ['sometimes', 'date'],
            'approved_by_user_id' => ['nullable', 'integer'],
            'description' => ['nullable', 'string'],
            'status' => ['nullable', 'string', 'max:50'],
        ];
    }

    public function messages(): array
    {
        return [
            'amount.numeric' => 'Amount must be a numeric value.',
        ];
    }
}