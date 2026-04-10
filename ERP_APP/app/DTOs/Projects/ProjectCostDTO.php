<?php

namespace App\DTOs\Projects;

use App\DTOs\UsersRoles\UserDTO;
use App\Models\Projects\ProjectCost;

/**
 * Data Transfer Object for ProjectCost entity.
 *
 * Used for type-safe data transfer between layers
 * and encapsulates project cost tracking data.
 *
 * @property int|null $id
 * @property string|null $projectName
 * @property string|null $costCategory
 * @property float|null $amount
 * @property string|null $dateIncurred
 * @property int|null $approvedByUserId
 * @property string|null $description
 * @property int|null $status
 * @property string|null $createdAt
 * @property string|null $updatedAt
 * @property UserDTO|null $approvedByUser
 */
class ProjectCostDTO
{
    /** @var int|null Unique identifier */
    public ?int $id;

    /** @var string|null Name of the project */
    public ?string $projectName;

    /** @var string|null Cost category (e.g., 'Materials', 'Labor', 'Equipment', 'Misc') */
    public ?string $costCategory;

    /** @var float|null Cost amount */
    public ?float $amount;

    /** @var string|null Date cost was incurred (Y-m-d) */
    public ?string $dateIncurred;

    /** @var int|null Foreign key to users table (approver) */
    public ?int $approvedByUserId;

    /** @var string|null Description of the cost */
    public ?string $description;

    /** @var int|null Status: 0=Pending, 1=Approved, 2=Rejected */
    public ?int $status;

    /** @var string|null Creation timestamp (ISO 8601) */
    public ?string $createdAt;

    /** @var string|null Last update timestamp (ISO 8601) */
    public ?string $updatedAt;

    /** @var UserDTO|null User who approved this cost */
    public ?UserDTO $approvedByUser;

    /**
     * Create a new ProjectCostDTO instance.
     *
     * @param array $data Optional data array for initialization
     */
    public function __construct(array $data = [])
    {
        $this->id = isset($data['id']) ? (int) $data['id'] : null;
        $this->projectName = $data['project_name'] ?? null;
        $this->costCategory = $data['cost_category'] ?? null;
        $this->amount = isset($data['amount']) ? (float) $data['amount'] : null;
        $this->dateIncurred = $data['date_incurred'] ?? null;
        $this->approvedByUserId = isset($data['approved_by_user_id']) ? (int) $data['approved_by_user_id'] : null;
        $this->description = $data['description'] ?? null;
        $this->status = isset($data['status']) ? (int) $data['status'] : null;
        $this->createdAt = $data['created_at'] ?? null;
        $this->updatedAt = $data['updated_at'] ?? null;
        $this->approvedByUser = $data['approvedByUser'] ?? null;
    }

    /**
     * Create DTO from Eloquent model instance.
     *
     * @param ProjectCost $model Eloquent model to convert
     * @return self New DTO instance with model data
     */
    public static function fromModel(ProjectCost $model): self
    {
        $data = [
            'id' => $model->id,
            'project_name' => $model->project_name,
            'cost_category' => $model->cost_category,
            'amount' => $model->amount,
            'date_incurred' => $model->date_incurred,
            'approved_by_user_id' => $model->approved_by_user_id,
            'description' => $model->description,
            'status' => $model->status,
            'created_at' => $model->created_at?->toIso8601String(),
            'updated_at' => $model->updated_at?->toIso8601String(),
        ];

        if ($model->relationLoaded('approvedByUser')) {
            $data['approvedByUser'] = UserDTO::fromModel($model->approvedByUser);
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
            'project_name' => $this->projectName,
            'cost_category' => $this->costCategory,
            'amount' => $this->amount,
            'date_incurred' => $this->dateIncurred,
            'approved_by_user_id' => $this->approvedByUserId,
            'description' => $this->description,
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
            'project_name' => $this->projectName,
            'cost_category' => $this->costCategory,
            'amount' => $this->amount,
            'date_incurred' => $this->dateIncurred,
            'approved_by_user_id' => $this->approvedByUserId,
            'description' => $this->description,
            'status' => $this->status,
        ];
    }
}
