<?php

namespace App\DTOs\HR;

use App\Models\HR\Performance;

class PerformanceDTO
{
    public ?int $id;

    public ?int $employeeId;

    public ?string $reviewPeriod;

    public ?float $kpiScore;

    public ?float $goalAchievement;

    public ?float $overallRating;

    public ?string $reviewerComments;

    public ?int $status;

    public ?string $createdAt;

    public ?string $updatedAt;

    public ?EmployeesDTO $employee;

    public function __construct(array $data = [])
    {
        $this->id = isset($data['id']) ? (int) $data['id'] : null;
        $this->employeeId = isset($data['employee_id']) ? (int) $data['employee_id'] : null;
        $this->reviewPeriod = $data['review_period'] ?? null;
        $this->kpiScore = isset($data['kpi_score']) ? (float) $data['kpi_score'] : null;
        $this->goalAchievement = isset($data['goal_achievement']) ? (float) $data['goal_achievement'] : null;
        $this->overallRating = isset($data['overall_rating']) ? (float) $data['overall_rating'] : null;
        $this->reviewerComments = $data['reviewer_comments'] ?? null;
        $this->status = isset($data['status']) ? (int) $data['status'] : null;
        $this->createdAt = $data['created_at'] ?? null;
        $this->updatedAt = $data['updated_at'] ?? null;
        $this->employee = $data['employee'] ?? null;
    }

    public static function fromModel(Performance $model): self
    {
        $data = [
            'id' => $model->id,
            'employee_id' => $model->employee_id,
            'review_period' => $model->review_period,
            'kpi_score' => $model->kpi_score,
            'goal_achievement' => $model->goal_achievement,
            'overall_rating' => $model->overall_rating,
            'reviewer_comments' => $model->reviewer_comments,
            'status' => $model->status,
            'created_at' => $model->created_at?->toIso8601String(),
            'updated_at' => $model->updated_at?->toIso8601String(),
        ];

        if ($model->relationLoaded('employee')) {
            $data['employee'] = EmployeesDTO::fromModel($model->employee);
        }

        return new self($data);
    }

    public static function fromArray(array $data): self
    {
        return new self($data);
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'employee_id' => $this->employeeId,
            'review_period' => $this->reviewPeriod,
            'kpi_score' => $this->kpiScore,
            'goal_achievement' => $this->goalAchievement,
            'overall_rating' => $this->overallRating,
            'reviewer_comments' => $this->reviewerComments,
            'status' => $this->status,
            'created_at' => $this->createdAt,
            'updated_at' => $this->updatedAt,
        ];
    }

    public function toModel(): array
    {
        return [
            'employee_id' => $this->employeeId,
            'review_period' => $this->reviewPeriod,
            'kpi_score' => $this->kpiScore,
            'goal_achievement' => $this->goalAchievement,
            'overall_rating' => $this->overallRating,
            'reviewer_comments' => $this->reviewerComments,
            'status' => $this->status,
        ];
    }
}
