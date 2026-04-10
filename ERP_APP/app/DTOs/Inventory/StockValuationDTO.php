<?php

namespace App\DTOs\Inventory;

use App\Models\Inventory\StockValuation;

/**
 * Data Transfer Object for StockValuation entity.
 *
 * Used for type-safe data transfer between layers
 * and encapsulates inventory valuation data.
 *
 * @property int|null $id
 * @property int|null $productId
 * @property string|null $valuationMethod
 * @property float|null $unitCost
 * @property int|null $quantityOnHand
 * @property float|null $totalValue
 * @property string|null $createdAt
 * @property string|null $updatedAt
 * @property ProductCatalogDTO|null $product
 */
class StockValuationDTO
{
    /** @var int|null Unique identifier */
    public ?int $id;

    /** @var int|null Foreign key to products table */
    public ?int $productId;

    /** @var string|null Valuation method (e.g., 'FIFO', 'LIFO', 'Weighted Average') */
    public ?string $valuationMethod;

    /** @var float|null Cost per unit */
    public ?float $unitCost;

    /** @var int|null Current stock quantity on hand */
    public ?int $quantityOnHand;

    /** @var float|null Total inventory value (unit_cost * quantity_on_hand) */
    public ?float $totalValue;

    /** @var string|null Creation timestamp (ISO 8601) */
    public ?string $createdAt;

    /** @var string|null Last update timestamp (ISO 8601) */
    public ?string $updatedAt;

    /** @var ProductCatalogDTO|null Related product */
    public ?ProductCatalogDTO $product;

    /**
     * Create a new StockValuationDTO instance.
     *
     * @param array $data Optional data array for initialization
     */
    public function __construct(array $data = [])
    {
        $this->id = isset($data['id']) ? (int) $data['id'] : null;
        $this->productId = isset($data['product_id']) ? (int) $data['product_id'] : null;
        $this->valuationMethod = $data['valuation_method'] ?? null;
        $this->unitCost = isset($data['unit_cost']) ? (float) $data['unit_cost'] : null;
        $this->quantityOnHand = isset($data['quantity_on_hand']) ? (int) $data['quantity_on_hand'] : null;
        $this->totalValue = isset($data['total_value']) ? (float) $data['total_value'] : null;
        $this->createdAt = $data['created_at'] ?? null;
        $this->updatedAt = $data['updated_at'] ?? null;
        $this->product = $data['product'] ?? null;
    }

    /**
     * Create DTO from Eloquent model instance.
     *
     * @param StockValuation $model Eloquent model to convert
     * @return self New DTO instance with model data
     */
    public static function fromModel(StockValuation $model): self
    {
        $data = [
            'id' => $model->id,
            'product_id' => $model->product_id,
            'valuation_method' => $model->valuation_method,
            'unit_cost' => $model->unit_cost,
            'quantity_on_hand' => $model->quantity_on_hand,
            'total_value' => $model->total_value,
            'created_at' => $model->created_at?->toIso8601String(),
            'updated_at' => $model->updated_at?->toIso8601String(),
        ];

        if ($model->relationLoaded('product')) {
            $data['product'] = ProductCatalogDTO::fromModel($model->product);
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
            'valuation_method' => $this->valuationMethod,
            'unit_cost' => $this->unitCost,
            'quantity_on_hand' => $this->quantityOnHand,
            'total_value' => $this->totalValue,
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
            'valuation_method' => $this->valuationMethod,
            'unit_cost' => $this->unitCost,
            'quantity_on_hand' => $this->quantityOnHand,
            'total_value' => $this->totalValue,
        ];
    }
}
