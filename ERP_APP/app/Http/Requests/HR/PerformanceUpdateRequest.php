<?php

namespace App\Http\Requests\HR;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for updating an existing Performance Review.
 */
class PerformanceUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'employee_id' => ['sometimes', 'integer', 'exists:employees,id'],
            'review_period' => ['sometimes', 'string', 'max:50'],
            'kpi_score' => ['sometimes', 'numeric', 'min:0', 'max:100'],
            'goal_achievement' => ['sometimes', 'numeric', 'min:0', 'max:100'],
            'overall_rating' => ['sometimes', 'numeric', 'min:0', 'max:5'],
            'reviewer_comments' => ['nullable', 'string'],
            'status' => ['nullable', 'string', 'max:50'],
        ];
    }

    public function messages(): array
    {
        return [
            'employee_id.exists' => 'The selected employee is invalid.',
            'kpi_score.max' => 'KPI score cannot exceed 100.',
            'goal_achievement.max' => 'Goal achievement cannot exceed 100.',
            'overall_rating.max' => 'Overall rating cannot exceed 5.',
        ];
    }
}