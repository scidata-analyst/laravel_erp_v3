<?php

namespace App\DTOs\Inventory;

class ProductCatalogDTO
{
    public function __construct(
        public readonly string $product_name,
        public readonly string $sku,
        public readonly ?string $category = null,
        public readonly ?float $unit_price = null,
        public readonly ?float $cost_price = null,
        public readonly ?string $warehouse = null,
        public readonly ?int $reorder_level = null,
        public readonly ?string $valuation_method = null,
        public readonly ?string $description = null,
        public readonly ?string $status = 'active',
        public readonly ?string $barcode = null,
        public readonly ?float $weight = null,
        public readonly mixed $dimensions = null,
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            product_name: $data['product_name'],
            sku: $data['sku'],
            category: $data['category'] ?? null,
            unit_price: isset($data['unit_price']) ? (float) $data['unit_price'] : (isset($data['base_price']) ? (float) $data['base_price'] : null),
            cost_price: isset($data['cost_price']) ? (float) $data['cost_price'] : null,
            warehouse: $data['warehouse'] ?? null,
            reorder_level: isset($data['reorder_level']) ? (int) $data['reorder_level'] : (isset($data['minimum_stock_level']) ? (int) $data['minimum_stock_level'] : null),
            valuation_method: $data['valuation_method'] ?? null,
            description: $data['description'] ?? null,
            status: $data['status'] ?? 'active',
            barcode: $data['barcode'] ?? null,
            weight: isset($data['weight']) ? (float) $data['weight'] : null,
            dimensions: $data['dimensions'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'product_name' => $this->product_name,
            'sku' => $this->sku,
            'category' => $this->category,
            'unit_price' => $this->unit_price,
            'cost_price' => $this->cost_price,
            'warehouse' => $this->warehouse,
            'reorder_level' => $this->reorder_level,
            'valuation_method' => $this->valuation_method,
            'description' => $this->description,
            'status' => $this->status,
            'barcode' => $this->barcode,
            'weight' => $this->weight,
            'dimensions' => $this->dimensions,
        ];
    }
}
