<?php

namespace App\DTOs\Inventory;

class ProductCatalogDTO
{
    public readonly string $product_name;
    public readonly string $sku;
    public readonly ?string $category;
    public readonly ?float $unit_price;
    public readonly ?float $cost_price;
    public readonly ?string $warehouse;
    public readonly ?int $reorder_level;
    public readonly ?string $valuation_method;
    public readonly ?string $description;
    public readonly ?string $status;
    public readonly ?string $barcode;
    public readonly ?float $weight;
    public readonly mixed $dimensions;

    public function __construct(array $data)
    {
        $this->product_name = (string)($data['product_name'] ?? '');
        $this->sku = (string)($data['sku'] ?? '');
        $this->category = $data['category'] ?? null;
        $this->unit_price = isset($data['unit_price']) ? (float)$data['unit_price'] : (isset($data['base_price']) ? (float)$data['base_price'] : null);
        $this->cost_price = isset($data['cost_price']) ? (float)$data['cost_price'] : null;
        $this->warehouse = $data['warehouse'] ?? null;
        $this->reorder_level = isset($data['reorder_level']) ? (int)$data['reorder_level'] : (isset($data['minimum_stock_level']) ? (int)$data['minimum_stock_level'] : null);
        $this->valuation_method = $data['valuation_method'] ?? null;
        $this->description = $data['description'] ?? null;
        $this->status = $data['status'] ?? 'active';
        $this->barcode = $data['barcode'] ?? null;
        $this->weight = isset($data['weight']) ? (float)$data['weight'] : null;
        $this->dimensions = $data['dimensions'] ?? null;
    }
}