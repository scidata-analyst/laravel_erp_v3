<?php

namespace App\DTOs\Production;

use App\Models\Production\MachineLabor;

class MachineLaborDTO
{
    public ?int $id;

    public ?int $workOrderId;

    public ?string $resourceName;

    public ?string $resourceType;

    public ?float $hoursUsed;

    public ?float $costPerHour;

    public ?float $totalCost;

    public ?string $createdAt;

    public ?string $updatedAt;

    public ?WorkOrdersDTO $workOrder;

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

    public static function fromArray(array $data): self
    {
        return new self($data);
    }

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
