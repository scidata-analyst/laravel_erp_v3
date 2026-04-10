<?php

namespace App\DTOs\Inventory;

use App\DTOs\Logistics\WarehousesDTO;
use App\Models\Inventory\StockMovements;

/**
 * Data Transfer Object for StockMovements entity.
 *
 * Used for type-safe data transfer between layers
 * and encapsulates inventory movement/transfer data.
 *
 * @property int|null $id
 * @property int|null $productId
 * @property string|null $movementType
 * @property int|null $quantity
 * @property int|null $fromWarehouseId
 * @property int|null $toWarehouseId
 * @property string|null $reason
 * @property string|null $createdAt
 * @property string|null $updatedAt
 * @property ProductCatalogDTO|null $product
 * @property WarehousesDTO|null $fromWarehouse
 * @property WarehousesDTO|null $toWarehouse
 */
class StockMovementsDTO
{
    /** @var int|null Unique identifier */
    public ?int $id;

    /** @var int|null Foreign key to products table */
    public ?int $productId;

    /** @var string|null Movement type (e.g., 'In', 'Out', 'Transfer', 'Adjustment') */
    public ?string $movementType;

    /** @var int|null Quantity moved */
    public ?int $quantity;

    /** @var int|null Source warehouse ID (for transfers) */
    public ?int $fromWarehouseId;

    /** @var int|null Destination warehouse ID (for transfers/receipts) */
    public ?int $toWarehouseId;

    /** @var string|null Reason for movement */
    public ?string $reason;

    /** @var string|null Creation timestamp (ISO 8601) */
    public ?string $createdAt;

    /** @var string|null Last update timestamp (ISO 8601) */
    public ?string $updatedAt;

    /** @var ProductCatalogDTO|null Related product */
    public ?ProductCatalogDTO $product;

    /** @var WarehousesDTO|null Source warehouse */
    public ?WarehousesDTO $fromWarehouse;

    /** @var WarehousesDTO|null Destination warehouse */
    public ?WarehousesDTO $toWarehouse;

    /**
     * Create a new StockMovementsDTO instance.
     *
     * @param array $data Optional data array for initialization
     */
    public function __construct(array $data = [])
    {
        $this->id = isset($data['id']) ? (int) $data['id'] : null;
        $this->productId = isset($data['product_id']) ? (int) $data['product_id'] : null;
        $this->movementType = $data['movement_type'] ?? null;
        $this->quantity = isset($data['quantity']) ? (int) $data['quantity'] : null;
        $this->fromWarehouseId = isset($data['from_warehouse_id']) ? (int) $data['from_warehouse_id'] : null;
        $this->toWarehouseId = isset($data['to_warehouse_id']) ? (int) $data['to_warehouse_id'] : null;
        $this->reason = $data['reason'] ?? null;
        $this->createdAt = $data['created_at'] ?? null;
        $this->updatedAt = $data['updated_at'] ?? null;
        $this->product = $data['product'] ?? null;
        $this->fromWarehouse = $data['fromWarehouse'] ?? null;
        $this->toWarehouse = $data['toWarehouse'] ?? null;
    }

    /**
     * Create DTO from Eloquent model instance.
     *
     * @param StockMovements $model Eloquent model to convert
     * @return self New DTO instance with model data
     */
    public static function fromModel(StockMovements $model): self
    {
        $data = [
            'id' => $model->id,
            'product_id' => $model->product_id,
            'movement_type' => $model->movement_type,
            'quantity' => $model->quantity,
            'from_warehouse_id' => $model->from_warehouse_id,
            'to_warehouse_id' => $model->to_warehouse_id,
            'reason' => $model->reason,
            'created_at' => $model->created_at?->toIso8601String(),
            'updated_at' => $model->updated_at?->toIso8601String(),
        ];

        if ($model->relationLoaded('product')) {
            $data['product'] = ProductCatalogDTO::fromModel($model->product);
        }

        if ($model->relationLoaded('fromWarehouse')) {
            $data['fromWarehouse'] = WarehousesDTO::fromModel($model->fromWarehouse);
        }

        if ($model->relationLoaded('toWarehouse')) {
            $data['toWarehouse'] = WarehousesDTO::fromModel($model->toWarehouse);
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
            'product_id' => $this->productId,
            'movement_type' => $this->movementType,
            'quantity' => $this->quantity,
            'from_warehouse_id' => $this->fromWarehouseId,
            'to_warehouse_id' => $this->toWarehouseId,
            'reason' => $this->reason,
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
            'product_id' => $this->productId,
            'movement_type' => $this->movementType,
            'quantity' => $this->quantity,
            'from_warehouse_id' => $this->fromWarehouseId,
            'to_warehouse_id' => $this->toWarehouseId,
            'reason' => $this->reason,
        ];
    }
}
