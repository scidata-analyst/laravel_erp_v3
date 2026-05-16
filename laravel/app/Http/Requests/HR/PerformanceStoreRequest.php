<?php

namespace App\Http\Requests\HR;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for creating a new Performance Review.
 */
class PerformanceStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'employee_id' => ['required', 'integer', 'exists:employees,id'],
            'review_period' => ['required', 'string', 'max:50'],
            'kpi_score' => ['required', 'numeric', 'min:0', 'max:100'],
            'goal_achievement' => ['required', 'numeric', 'min:0', 'max:100'],
            'overall_rating' => ['required', 'numeric', 'min:0', 'max:5'],
            'reviewer_comments' => ['nullable', 'string'],
            'status' => ['nullable', 'string', 'max:50'],
        ];
    }

    public function messages(): array
    {
        return [
            'employee_id.required' => 'The employee is required.',
            'employee_id.exists' => 'The selected employee is invalid.',
            'review_period.required' => 'The review period is required.',
            'kpi_score.required' => 'The KPI score is required.',
            'kpi_score.max' => 'KPI score cannot exceed 100.',
            'goal_achievement.required' => 'The goal achievement is required.',
            'goal_achievement.max' => 'Goal achievement cannot exceed 100.',
            'overall_rating.required' => 'The overall rating is required.',
            'overall_rating.max' => 'Overall rating cannot exceed 5.',
        ];
    }
}