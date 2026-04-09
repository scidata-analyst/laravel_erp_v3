<?php

namespace App\DTOs\Projects;

use App\DTOs\HR\EmployeesDTO;
use App\Models\Projects\Resources;

class ResourcesDTO
{
    public ?int $id;

    public ?int $employeeId;

    public ?string $projectName;

    public ?float $allocationPercentage;

    public ?string $fromDate;

    public ?string $toDate;

    public ?string $roleOnProject;

    public ?string $createdAt;

    public ?string $updatedAt;

    public ?EmployeesDTO $employee;

    public function __construct(array $data = [])
    {
        $this->id = isset($data['id']) ? (int) $data['id'] : null;
        $this->employeeId = isset($data['employee_id']) ? (int) $data['employee_id'] : null;
        $this->projectName = $data['project_name'] ?? null;
        $this->allocationPercentage = isset($data['allocation_percentage']) ? (float) $data['allocation_percentage'] : null;
        $this->fromDate = $data['from_date'] ?? null;
        $this->toDate = $data['to_date'] ?? null;
        $this->roleOnProject = $data['role_on_project'] ?? null;
        $this->createdAt = $data['created_at'] ?? null;
        $this->updatedAt = $data['updated_at'] ?? null;
        $this->employee = $data['employee'] ?? null;
    }

    public static function fromModel(Resources $model): self
    {
        $data = [
            'id' => $model->id,
            'employee_id' => $model->employee_id,
            'project_name' => $model->project_name,
            'allocation_percentage' => $model->allocation_percentage,
            'from_date' => $model->from_date,
            'to_date' => $model->to_date,
            'role_on_project' => $model->role_on_project,
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
            'project_name' => $this->projectName,
            'allocation_percentage' => $this->allocationPercentage,
            'from_date' => $this->fromDate,
            'to_date' => $this->toDate,
            'role_on_project' => $this->roleOnProject,
            'created_at' => $this->createdAt,
            'updated_at' => $this->updatedAt,
        ];
    }

    public function toModel(): array
    {
        return [
            'employee_id' => $this->employeeId,
            'project_name' => $this->projectName,
            'allocation_percentage' => $this->allocationPercentage,
            'from_date' => $this->fromDate,
            'to_date' => $this->toDate,
            'role_on_project' => $this->roleOnProject,
        ];
    }
}
