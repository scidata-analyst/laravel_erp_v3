<?php

namespace App\Http\Requests\HR;

use App\Traits\Validation\ValidationResponseTrait;
use App\Rules\HR\PerformanceRatingRule;
use App\Rules\HR\ReviewStatusRule;
use App\Rules\Common\PaginationLimit;
use Illuminate\Foundation\Http\FormRequest;

class PerformanceRequest extends FormRequest
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
                'employee_id' => 'nullable|exists:employees,id',
                'overall_rating' => ['nullable', new PerformanceRatingRule]
            ];
        }

        return [
            'employee_id' => 'required|exists:employees,id',
            'review_period' => 'nullable|string|max:255',
            'kpi_score' => 'nullable|numeric|min:0|max:100',
            'goal_achievement' => 'nullable|numeric|min:0|max:150',
            'overall_rating' => ['required_without:rating', new PerformanceRatingRule],
            'rating' => ['required_without:overall_rating', new PerformanceRatingRule],
            'reviewer_id' => 'nullable|exists:employees,id',
            'reviewer' => 'nullable|string|max:255',
            'review_date' => 'required|date',
            'reviewer_comments' => 'nullable|string|max:2000',
            'comments' => 'nullable|string|max:2000',
            'status' => ['required', new ReviewStatusRule],
            'improvement_plan' => 'nullable|array'
        ];
    }
}
