<?php

namespace App\Http\Resources\HR;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PerformanceResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'employee_id' => $this->employee_id,
            'review_period' => $this->review_period,
            'kpi_score' => $this->kpi_score,
            'goal_achievement' => $this->goal_achievement,
            'rating' => $this->rating,
            'overall_rating' => $this->overall_rating,
            'reviewer_id' => $this->reviewer_id,
            'review_date' => $this->review_date,
            'comments' => $this->comments,
            'reviewer_comments' => $this->reviewer_comments,
            'status' => $this->status,
            'improvement_plan' => $this->improvement_plan,
            'employee' => new EmployeesResource($this->whenLoaded('employee')),
            'reviewer' => $this->reviewer,
            'reviewer_details' => new EmployeesResource($this->whenLoaded('reviewer')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
