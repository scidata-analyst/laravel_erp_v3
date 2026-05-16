<?php

namespace App\DTOs\Production;

use App\Models\Production\MachineLabor;

/**
 * Data Transfer Object for MachineLabor entity.
 *
 * Used for type-safe data transfer between layers
 * and encapsulates production resource tracking data.
 *
 * @property int|null $id
 * @property int|null $workOrderId
 * @property string|null $resourceName
 * @property string|null $resourceType
 * @property float|null $hoursUsed
 * @property float|null $costPerHour
 * @property float|null $totalCost
 * @property string|null $createdAt
 * @property string|null $updatedAt
 * @property WorkOrdersDTO|null $workOrder
 */
class MachineLaborDTO
{
    /** @var int|null Unique identifier */
    public ?int $id;

    /** @var int|null Foreign key to work_orders table */
    public ?int $workOrderId;

    /** @var string|null Name of machine or laborer */
    public ?string $resourceName;

    /** @var string|null Type of resource (e.g., 'Machine', 'Labor') */
    public ?string $resourceType;

    /** @var float|null Hours used */
    public ?float $hoursUsed;

    /** @var float|null Cost per hour */
    public ?float $costPerHour;

    /** @var float|null Total cost (hours_used * cost_per_hour) */
    public ?float $totalCost;

    /** @var string|null Creation timestamp (ISO 8601) */
    public ?string $createdAt;

    /** @var string|null Last update timestamp (ISO 8601) */
    public ?string $updatedAt;

    /** @var WorkOrdersDTO|null Related work order */
    public ?WorkOrdersDTO $workOrder;

    /**
     * Create a new MachineLaborDTO instance.
     *
     * @param array $data Optional data array for initialization
     */
    public function __construct(array $data = [])
    {
        $this->id = isset($data['id']) ? (int) $data['id'] : null;
        $this->workOrderId = isset($data['work_order_id']) ? (int) $data['work_order_id'] : null;
        $this->resourceName = $data['resource_name'] ?? null;
        $this->resourceType = $data['resource_type'] ?? null;
        $this->hoursUsed = isset($data['hours_used']) ? (float) $data['hours_used'] : null;
        $this->costPerHour = isset($data['cost_per_hour']) ? (float) $data['cost_per_hour'] : null;
        $this->totalCost = isset($data['total_cost']) ? (float) $data['total_cost'] : null;
        $this->createdAt = $data['created_at'] ?? null;
        $this->updatedAt = $data['updated_at'] ?? null;
        $this->workOrder = $data['workOrder'] ?? null;
    }

    /**
     * Create DTO from Eloquent model instance.
     *
     * @param MachineLabor $model Eloquent model to convert
     * @return self New DTO instance with model data
     */
    public static function fromModel(MachineLabor $model): self
    {
        $data = [
            'id' => $model->id,
            'work_order_id' => $model->work_order_id,
            'resource_name' => $model->resource_name,
            'resource_type' => $model->resource_type,
            'hours_used' => $model->hours_used,
            'cost_per_hour' => $model->cost_per_hour,
            'total_cost' => $model->total_cost,
            'created_at' => $model->created_at?->toIso8601String(),
            'updated_at' => $model->updated_at?->toIso8601String(),
        ];

        if ($model->relationLoaded('workOrder')) {
            $data['workOrder'] = WorkOrdersDTO::fromModel($model->workOrder);
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
            'work_order_id' => $this->workOrderId,
            'resource_name' => $this->resourceName,
            'resource_type' => $this->resourceType,
            'hours_used' => $this->hoursUsed,
            'cost_per_hour' => $this->costPerHour,
            'total_cost' => $this->totalCost,
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
            'work_order_id' => $this->workOrderId,
            'resource_name' => $this->resourceName,
            'resource_type' => $this->resourceType,
            'hours_used' => $this->hoursUsed,
            'cost_per_hour' => $this->costPerHour,
            'total_cost' => $this->totalCost,
        ];
    }
}
