<?php

namespace App\DTOs\Production;

use App\Models\Production\Bom;

class BomDTO
{
    public ?int $id;

    public ?string $finishedProductName;

    public ?string $version;

    public ?int $leadTimeDays;

    public ?int $status;

    public ?string $createdAt;

    public ?string $updatedAt;

    public ?array $workOrders;

    public function __construct(array $data = [])
    {
        $this->id = isset($data['id']) ? (int) $data['id'] : null;
        $this->finishedProductName = $data['finished_product_name'] ?? null;
        $this->version = $data['version'] ?? null;
        $this->leadTimeDays = isset($data['lead_time_days']) ? (int) $data['lead_time_days'] : null;
        $this->status = isset($data['status']) ? (int) $data['status'] : null;
        $this->createdAt = $data['created_at'] ?? null;
        $this->updatedAt = $data['updated_at'] ?? null;
        $this->workOrders = $data['workOrders'] ?? null;
    }

    public static function fromModel(Bom $model): self
    {
        $data = [
            'id' => $model->id,
            'finished_product_name' => $model->finished_product_name,
            'version' => $model->version,
            'lead_time_days' => $model->lead_time_days,
            'status' => $model->status,
            'created_at' => $model->created_at?->toIso8601String(),
            'updated_at' => $model->updated_at?->toIso8601String(),
        ];

        if ($model->relationLoaded('workOrders')) {
            $data['workOrders'] = $model->workOrders->map(fn ($w) => WorkOrdersDTO::fromModel($w))->all();
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
            'finished_product_name' => $this->finishedProductName,
            'version' => $this->version,
            'lead_time_days' => $this->leadTimeDays,
            'status' => $this->status,
            'created_at' => $this->createdAt,
            'updated_at' => $this->updatedAt,
        ];
    }

    public function toModel(): array
    {
        return [
            'finished_product_name' => $this->finishedProductName,
            'version' => $this->version,
            'lead_time_days' => $this->leadTimeDays,
            'status' => $this->status,
        ];
    }
}
