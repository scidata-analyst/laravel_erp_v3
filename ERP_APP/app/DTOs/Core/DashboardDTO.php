<?php

namespace App\DTOs\Core;

use App\Models\Core\Dashboard;

class DashboardDTO
{
    public ?int $id;

    public ?float $totalRevenue;

    public ?int $salesOrders;

    public ?string $createdAt;

    public ?string $updatedAt;

    public function __construct(array $data = [])
    {
        $this->id = isset($data['id']) ? (int) $data['id'] : null;
        $this->totalRevenue = isset($data['total_revenue']) ? (float) $data['total_revenue'] : null;
        $this->salesOrders = isset($data['sales_orders']) ? (int) $data['sales_orders'] : null;
        $this->createdAt = $data['created_at'] ?? null;
        $this->updatedAt = $data['updated_at'] ?? null;
    }

    public static function fromModel(Dashboard $model): self
    {
        return new self([
            'id' => $model->id,
            'total_revenue' => $model->total_revenue,
            'sales_orders' => $model->sales_orders,
            'created_at' => $model->created_at?->toIso8601String(),
            'updated_at' => $model->updated_at?->toIso8601String(),
        ]);
    }

    public static function fromArray(array $data): self
    {
        return new self($data);
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'total_revenue' => $this->totalRevenue,
            'sales_orders' => $this->salesOrders,
            'created_at' => $this->createdAt,
            'updated_at' => $this->updatedAt,
        ];
    }

    public function toModel(): array
    {
        return [
            'total_revenue' => $this->totalRevenue,
            'sales_orders' => $this->salesOrders,
        ];
    }
}
