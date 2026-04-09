<?php

namespace App\DTOs\Inventory;

use App\DTOs\Logistics\WarehousesDTO;
use App\Models\Inventory\ProductCatalog;

class ProductCatalogDTO
{
    public ?int $id;

    public ?string $productName;

    public ?string $sku;

    public ?string $category;

    public ?float $unitPrice;

    public ?float $costPrice;

    public ?int $warehouseId;

    public ?int $reorderLevel;

    public ?string $valuationMethod;

    public ?string $description;

    public ?int $status;

    public ?string $createdAt;

    public ?string $updatedAt;

    public ?WarehousesDTO $warehouse;

    public ?array $batchTrackings;

    public ?array $stockMovements;

    public function __construct(array $data = [])
    {
        $this->id = isset($data['id']) ? (int) $data['id'] : null;
        $this->productName = $data['product_name'] ?? null;
        $this->sku = $data['sku'] ?? null;
        $this->category = $data['category'] ?? null;
        $this->unitPrice = isset($data['unit_price']) ? (float) $data['unit_price'] : null;
        $this->costPrice = isset($data['cost_price']) ? (float) $data['cost_price'] : null;
        $this->warehouseId = isset($data['warehouse_id']) ? (int) $data['warehouse_id'] : null;
        $this->reorderLevel = isset($data['reorder_level']) ? (int) $data['reorder_level'] : null;
        $this->valuationMethod = $data['valuation_method'] ?? null;
        $this->description = $data['description'] ?? null;
        $this->status = isset($data['status']) ? (int) $data['status'] : null;
        $this->createdAt = $data['created_at'] ?? null;
        $this->updatedAt = $data['updated_at'] ?? null;
        $this->warehouse = $data['warehouse'] ?? null;
        $this->batchTrackings = $data['batchTrackings'] ?? null;
        $this->stockMovements = $data['stockMovements'] ?? null;
    }

    public static function fromModel(ProductCatalog $model): self
    {
        $data = [
            'id' => $model->id,
            'product_name' => $model->product_name,
            'sku' => $model->sku,
            'category' => $model->category,
            'unit_price' => $model->unit_price,
            'cost_price' => $model->cost_price,
            'warehouse_id' => $model->warehouse_id,
            'reorder_level' => $model->reorder_level,
            'valuation_method' => $model->valuation_method,
            'description' => $model->description,
            'status' => $model->status,
            'created_at' => $model->created_at?->toIso8601String(),
            'updated_at' => $model->updated_at?->toIso8601String(),
        ];

        if ($model->relationLoaded('warehouse')) {
            $data['warehouse'] = WarehousesDTO::fromModel($model->warehouse);
        }

        if ($model->relationLoaded('batchTrackings')) {
            $data['batchTrackings'] = $model->batchTrackings->map(fn ($b) => BatchTrackingDTO::fromModel($b))->all();
        }

        if ($model->relationLoaded('stockMovements')) {
            $data['stockMovements'] = $model->stockMovements->map(fn ($s) => StockMovementsDTO::fromModel($s))->all();
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
            'product_name' => $this->productName,
            'sku' => $this->sku,
            'category' => $this->category,
            'unit_price' => $this->unitPrice,
            'cost_price' => $this->costPrice,
            'warehouse_id' => $this->warehouseId,
            'reorder_level' => $this->reorderLevel,
            'valuation_method' => $this->valuationMethod,
            'description' => $this->description,
            'status' => $this->status,
            'created_at' => $this->createdAt,
            'updated_at' => $this->updatedAt,
        ];
    }

    public function toModel(): array
    {
        return [
            'product_name' => $this->productName,
            'sku' => $this->sku,
            'category' => $this->category,
            'unit_price' => $this->unitPrice,
            'cost_price' => $this->costPrice,
            'warehouse_id' => $this->warehouseId,
            'reorder_level' => $this->reorderLevel,
            'valuation_method' => $this->valuationMethod,
            'description' => $this->description,
            'status' => $this->status,
        ];
    }
}
