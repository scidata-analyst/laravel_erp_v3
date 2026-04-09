<?php

namespace App\DTOs\Inventory;

use App\DTOs\Logistics\WarehousesDTO;
use App\Models\Inventory\StockMovements;

class StockMovementsDTO
{
    public ?int $id;

    public ?int $productId;

    public ?string $movementType;

    public ?int $quantity;

    public ?int $fromWarehouseId;

    public ?int $toWarehouseId;

    public ?string $reason;

    public ?string $createdAt;

    public ?string $updatedAt;

    public ?ProductCatalogDTO $product;

    public ?WarehousesDTO $fromWarehouse;

    public ?WarehousesDTO $toWarehouse;

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

    public static function fromArray(array $data): self
    {
        return new self($data);
    }

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
