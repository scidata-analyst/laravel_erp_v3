<?php

namespace App\DTOs\Core;

use App\Models\Core\Dashboard;

/**
 * Data Transfer Object for Dashboard entity.
 *
 * Used for type-safe data transfer between layers
 * and encapsulates dashboard summary/analytics data.
 *
 * @property int|null $id
 * @property float|null $totalRevenue
 * @property int|null $salesOrders
 * @property string|null $createdAt
 * @property string|null $updatedAt
 */
class DashboardDTO
{
    /** @var int|null Unique identifier */
    public ?int $id;

    /** @var float|null Total revenue amount */
    public ?float $totalRevenue;

    /** @var int|null Total number of sales orders */
    public ?int $salesOrders;

    /** @var string|null Creation timestamp (ISO 8601) */
    public ?string $createdAt;

    /** @var string|null Last update timestamp (ISO 8601) */
    public ?string $updatedAt;

    /**
     * Create a new DashboardDTO instance.
     *
     * @param array $data Optional data array for initialization
     */
    public function __construct(array $data = [])
    {
        $this->id = isset($data['id']) ? (int) $data['id'] : null;
        $this->totalRevenue = isset($data['total_revenue']) ? (float) $data['total_revenue'] : null;
        $this->salesOrders = isset($data['sales_orders']) ? (int) $data['sales_orders'] : null;
        $this->createdAt = $data['created_at'] ?? null;
        $this->updatedAt = $data['updated_at'] ?? null;
    }

    /**
     * Create DTO from Eloquent model instance.
     *
     * @param Dashboard $model Eloquent model to convert
     * @return self New DTO instance with model data
     */
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
            'total_revenue' => $this->totalRevenue,
            'sales_orders' => $this->salesOrders,
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
            'total_revenue' => $this->totalRevenue,
            'sales_orders' => $this->salesOrders,
        ];
    }
}
