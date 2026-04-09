<?php

namespace App\DTOs\Inventory;

use App\Models\Inventory\StockValuation;

class StockValuationDTO
{
    public ?int $id;

    public ?int $productId;

    public ?string $valuationMethod;

    public ?float $unitCost;

    public ?int $quantityOnHand;

    public ?float $totalValue;

    public ?string $createdAt;

    public ?string $updatedAt;

    public ?ProductCatalogDTO $product;

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

    public static function fromArray(array $data): self
    {
        return new self($data);
    }

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
