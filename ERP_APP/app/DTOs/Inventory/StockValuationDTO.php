<?php

namespace App\DTOs\Inventory;

class StockValuationDTO
{
    public readonly int $product_id;
    public readonly ?int $warehouse_id;
    public readonly float $quantity_on_hand;
    public readonly float $unit_cost;
    public readonly float $total_value;
    public readonly string $valuation_method;
    public readonly ?string $valuation_date;
    public readonly ?string $notes;

    public function __construct(array $data)
    {
        $this->product_id = (int)($data['product_id'] ?? 0);
        $this->warehouse_id = isset($data['warehouse_id']) ? (int)$data['warehouse_id'] : null;
        $this->quantity_on_hand = isset($data['quantity_on_hand']) ? (float)$data['quantity_on_hand'] : 0;
        $this->unit_cost = isset($data['unit_cost']) ? (float)$data['unit_cost'] : 0;
        $this->total_value = isset($data['total_value']) ? (float)$data['total_value'] : 0;
        $this->valuation_method = $data['valuation_method'] ?? '';
        $this->valuation_date = $data['valuation_date'] ?? null;
        $this->notes = $data['notes'] ?? null;
    }
}