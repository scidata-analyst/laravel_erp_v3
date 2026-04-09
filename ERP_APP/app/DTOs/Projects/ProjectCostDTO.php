<?php

namespace App\DTOs\Projects;

use App\DTOs\UsersRoles\UserDTO;
use App\Models\Projects\ProjectCost;

class ProjectCostDTO
{
    public ?int $id;

    public ?string $projectName;

    public ?string $costCategory;

    public ?float $amount;

    public ?string $dateIncurred;

    public ?int $approvedByUserId;

    public ?string $description;

    public ?int $status;

    public ?string $createdAt;

    public ?string $updatedAt;

    public ?UserDTO $approvedByUser;

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

    public static function fromArray(array $data): self
    {
        return new self($data);
    }

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
