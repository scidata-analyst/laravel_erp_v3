<?php

namespace App\DTOs\Production;

use App\Models\Production\WorkOrders;

class WorkOrdersDTO
{
    public ?int $id;

    public ?int $bomId;

    public ?int $quantityToProduce;

    public ?string $priority;

    public ?string $startDate;

    public ?string $endDate;

    public ?string $workshopLine;

    public ?int $status;

    public ?string $createdAt;

    public ?string $updatedAt;

    public ?BomDTO $bom;

    public function __construct(array $data = [])
    {
        $this->id = isset($data['id']) ? (int) $data['id'] : null;
        $this->bomId = isset($data['bom_id']) ? (int) $data['bom_id'] : null;
        $this->quantityToProduce = isset($data['quantity_to_produce']) ? (int) $data['quantity_to_produce'] : null;
        $this->priority = $data['priority'] ?? null;
        $this->startDate = $data['start_date'] ?? null;
        $this->endDate = $data['end_date'] ?? null;
        $this->workshopLine = $data['workshop_line'] ?? null;
        $this->status = isset($data['status']) ? (int) $data['status'] : null;
        $this->createdAt = $data['created_at'] ?? null;
        $this->updatedAt = $data['updated_at'] ?? null;
        $this->bom = $data['bom'] ?? null;
    }

    public static function fromModel(WorkOrders $model): self
    {
        $data = [
            'id' => $model->id,
            'bom_id' => $model->bom_id,
            'quantity_to_produce' => $model->quantity_to_produce,
            'priority' => $model->priority,
            'start_date' => $model->start_date,
            'end_date' => $model->end_date,
            'workshop_line' => $model->workshop_line,
            'status' => $model->status,
            'created_at' => $model->created_at?->toIso8601String(),
            'updated_at' => $model->updated_at?->toIso8601String(),
        ];

        if ($model->relationLoaded('bom')) {
            $data['bom'] = BomDTO::fromModel($model->bom);
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
            'bom_id' => $this->bomId,
            'quantity_to_produce' => $this->quantityToProduce,
            'priority' => $this->priority,
            'start_date' => $this->startDate,
            'end_date' => $this->endDate,
            'workshop_line' => $this->workshopLine,
            'status' => $this->status,
            'created_at' => $this->createdAt,
            'updated_at' => $this->updatedAt,
        ];
    }

    public function toModel(): array
    {
        return [
            'bom_id' => $this->bomId,
            'quantity_to_produce' => $this->quantityToProduce,
            'priority' => $this->priority,
            'start_date' => $this->startDate,
            'end_date' => $this->endDate,
            'workshop_line' => $this->workshopLine,
            'status' => $this->status,
        ];
    }
}
