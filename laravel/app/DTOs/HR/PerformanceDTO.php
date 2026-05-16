<?php

namespace App\DTOs\HR;

use App\Models\HR\Performance;

/**
 * Data Transfer Object for Performance entity.
 *
 * Used for type-safe data transfer between layers
 * and encapsulates performance review data.
 *
 * @property int|null $id
 * @property int|null $employeeId
 * @property string|null $reviewPeriod
 * @property float|null $kpiScore
 * @property float|null $goalAchievement
 * @property float|null $overallRating
 * @property string|null $reviewerComments
 * @property int|null $status
 * @property string|null $createdAt
 * @property string|null $updatedAt
 * @property EmployeesDTO|null $employee
 */
class PerformanceDTO
{
    /** @var int|null Unique identifier */
    public ?int $id;

    /** @var int|null Foreign key to employees table */
    public ?int $employeeId;

    /** @var string|null Review period (e.g., '2024-Q1', '2024-01') */
    public ?string $reviewPeriod;

    /** @var float|null Key Performance Indicator score (0-100) */
    public ?float $kpiScore;

    /** @var float|null Goal achievement percentage (0-100) */
    public ?float $goalAchievement;

    /** @var float|null Overall rating (0-5) */
    public ?float $overallRating;

    /** @var string|null Reviewer's comments/feedback */
    public ?string $reviewerComments;

    /** @var int|null Status: 0=Pending, 1=InProgress, 2=Completed, 3=Cancelled */
    public ?int $status;

    /** @var string|null Creation timestamp (ISO 8601) */
    public ?string $createdAt;

    /** @var string|null Last update timestamp (ISO 8601) */
    public ?string $updatedAt;

    /** @var EmployeesDTO|null Related employee */
    public ?EmployeesDTO $employee;

    /**
     * Create a new PerformanceDTO instance.
     *
     * @param array $data Optional data array for initialization
     */
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

    /**
     * Create DTO from Eloquent model instance.
     *
     * @param Performance $model Eloquent model to convert
     * @return self New DTO instance with model data
     */
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

    /**
     * Create DTO from plain array data.
     *
     * @param array $data Associative array with DTO properties
     * @return self New DTO instance
     */
    public static function fromArray(array $data): self
    {
        return new self($data);
    }

    /**
     * Convert DTO to array representation.
     *
     * @return array Array with snake_case keys matching database columns
     */
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

    /**
     * Convert DTO to array for Eloquent model creation/update.
     *
     * Returns fillable attributes only, excluding timestamps
     * and foreign keys for related models.
     *
     * @return array Associative array for model mass assignment
     */
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
