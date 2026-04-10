<?php

namespace App\DTOs\Projects;

use App\DTOs\HR\EmployeesDTO;
use App\Models\Projects\Resources;

/**
 * Data Transfer Object for Resources entity.
 *
 * Used for type-safe data transfer between layers
 * and encapsulates project resource allocation data.
 *
 * @property int|null $id
 * @property int|null $employeeId
 * @property string|null $projectName
 * @property float|null $allocationPercentage
 * @property string|null $fromDate
 * @property string|null $toDate
 * @property string|null $roleOnProject
 * @property string|null $createdAt
 * @property string|null $updatedAt
 * @property EmployeesDTO|null $employee
 */
class ResourcesDTO
{
    /** @var int|null Unique identifier */
    public ?int $id;

    /** @var int|null Foreign key to employees table */
    public ?int $employeeId;

    /** @var string|null Name of the project */
    public ?string $projectName;

    /** @var float|null Allocation percentage (0-100) */
    public ?float $allocationPercentage;

    /** @var string|null Start date of allocation (Y-m-d) */
    public ?string $fromDate;

    /** @var string|null End date of allocation (Y-m-d) */
    public ?string $toDate;

    /** @var string|null Role assigned on project (e.g., 'Developer', 'Designer', 'Manager') */
    public ?string $roleOnProject;

    /** @var string|null Creation timestamp (ISO 8601) */
    public ?string $createdAt;

    /** @var string|null Last update timestamp (ISO 8601) */
    public ?string $updatedAt;

    /** @var EmployeesDTO|null Related employee */
    public ?EmployeesDTO $employee;

    /**
     * Create a new ResourcesDTO instance.
     *
     * @param array $data Optional data array for initialization
     */
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

    /**
     * Create DTO from Eloquent model instance.
     *
     * @param Resources $model Eloquent model to convert
     * @return self New DTO instance with model data
     */
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
            'project_name' => $this->projectName,
            'allocation_percentage' => $this->allocationPercentage,
            'from_date' => $this->fromDate,
            'to_date' => $this->toDate,
            'role_on_project' => $this->roleOnProject,
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
            'project_name' => $this->projectName,
            'allocation_percentage' => $this->allocationPercentage,
            'from_date' => $this->fromDate,
            'to_date' => $this->toDate,
            'role_on_project' => $this->roleOnProject,
        ];
    }
}
