<?php

namespace App\DTOs\Inventory;

use App\DTOs\Logistics\WarehousesDTO;
use App\Models\Inventory\ProductCatalog;

/**
 * Data Transfer Object for ProductCatalog entity.
 *
 * Used for type-safe data transfer between layers
 * and encapsulates product/inventory data with relationships.
 *
 * @property int|null $id
 * @property string|null $productName
 * @property string|null $sku
 * @property string|null $category
 * @property float|null $unitPrice
 * @property float|null $costPrice
 * @property int|null $warehouseId
 * @property int|null $reorderLevel
 * @property string|null $valuationMethod
 * @property string|null $description
 * @property int|null $status
 * @property string|null $createdAt
 * @property string|null $updatedAt
 * @property WarehousesDTO|null $warehouse
 * @property array|null $batchTrackings
 * @property array|null $stockMovements
 */
class ProductCatalogDTO
{
    /** @var int|null Unique identifier */
    public ?int $id;

    /** @var string|null Product name */
    public ?string $productName;

    /** @var string|null Stock Keeping Unit (unique product identifier) */
    public ?string $sku;

    /** @var string|null Product category */
    public ?string $category;

    /** @var float|null Selling price per unit */
    public ?float $unitPrice;

    /** @var float|null Cost price per unit (for profit calculation) */
    public ?float $costPrice;

    /** @var int|null Foreign key to warehouses table */
    public ?int $warehouseId;

    /** @var int|null Minimum stock level to trigger reorder */
    public ?int $reorderLevel;

    /** @var string|null Inventory valuation method (e.g., 'FIFO', 'LIFO', 'Weighted Average') */
    public ?string $valuationMethod;

    /** @var string|null Product description */
    public ?string $description;

    /** @var int|null Status: 0=Inactive, 1=Active, 2=Discontinued */
    public ?int $status;

    /** @var string|null Creation timestamp (ISO 8601) */
    public ?string $createdAt;

    /** @var string|null Last update timestamp (ISO 8601) */
    public ?string $updatedAt;

    /** @var WarehousesDTO|null Related warehouse */
    public ?WarehousesDTO $warehouse;

    /** @var array|null Collection of related batch tracking records */
    public ?array $batchTrackings;

    /** @var array|null Collection of related stock movements */
    public ?array $stockMovements;

    /**
     * Create a new ProductCatalogDTO instance.
     *
     * @param array $data Optional data array for initialization
     */
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

    /**
     * Create DTO from Eloquent model instance.
     *
     * @param ProductCatalog $model Eloquent model to convert
     * @return self New DTO instance with model data
     */
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
