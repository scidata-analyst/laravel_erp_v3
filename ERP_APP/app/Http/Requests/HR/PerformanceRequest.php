<?php

namespace App\Http\Requests\HR;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for validating Performance Review data.
 *
 * Validates fields based on the Performance model fillable attributes:
 * - employee_id: required, exists in employees table (foreign key relationship)
 * - review_period: required, string, max 50
 * - kpi_score: nullable, numeric, between 0 and 100
 * - goal_achievement: nullable, string, max 500
 * - overall_rating: nullable, numeric, between 1 and 5
 * - reviewer_comments: nullable, string, max 1000
 * - status: nullable, string, max 50
 */
class PerformanceRequest extends FormRequest
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
        // Get the performance review ID for unique validation on updates
        $performanceId = $this->route('performance');

        return [
            // Employee: required, must exist in employees table
            'employee_id' => ['required', 'exists:App\Models\HR\Employees,id'],

            // Review period: required, string, max 50 characters (e.g., "Q1 2024", "2024")
            'review_period' => ['required', 'string', 'max:50'],

            // KPI score: optional, numeric, between 0 and 100
            'kpi_score' => ['nullable', 'numeric', 'min:0', 'max:100'],

            // Goal achievement: optional, string, max 500 characters
            'goal_achievement' => ['nullable', 'string', 'max:500'],

            // Overall rating: optional, numeric, between 1 and 5
            'overall_rating' => ['nullable', 'numeric', 'min:1', 'max:5'],

            // Reviewer comments: optional, string, max 1000 characters
            'reviewer_comments' => ['nullable', 'string', 'max:1000'],

            // Status: optional, string, max 50 characters
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
            'employee_id.required' => 'Please select an employee.',
            'employee_id.exists' => 'The selected employee does not exist.',
            'review_period.required' => 'The review period is required.',
            'review_period.max' => 'Review period must not exceed 50 characters.',
            'kpi_score.numeric' => 'KPI score must be a numeric value.',
            'kpi_score.min' => 'KPI score must be at least 0.',
            'kpi_score.max' => 'KPI score must not exceed 100.',
            'goal_achievement.max' => 'Goal achievement must not exceed 500 characters.',
            'overall_rating.numeric' => 'Overall rating must be a numeric value.',
            'overall_rating.min' => 'Overall rating must be at least 1.',
            'overall_rating.max' => 'Overall rating must not exceed 5.',
            'reviewer_comments.max' => 'Reviewer comments must not exceed 1000 characters.',
            'status.max' => 'Status must not exceed 50 characters.',
        ];
    }
}
