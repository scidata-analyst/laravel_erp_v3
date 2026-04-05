<?php

namespace App\DTOs\Inventory;

class StockValuationDTO
{
    public function __construct(
        public readonly int $product_id,
        public readonly ?int $warehouse_id = null,
        public readonly float $quantity_on_hand = 0,
        public readonly float $unit_cost = 0,
        public readonly float $total_value = 0,
        public readonly string $valuation_method = '',
        public readonly ?string $valuation_date = null,
        public readonly ?string $notes = null,
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            product_id: (int) $data['product_id'],
            warehouse_id: isset($data['warehouse_id']) ? (int) $data['warehouse_id'] : null,
            quantity_on_hand: (float) ($data['quantity_on_hand'] ?? 0),
            unit_cost: (float) $data['unit_cost'],
            total_value: (float) $data['total_value'],
            valuation_method: $data['valuation_method'],
            valuation_date: $data['valuation_date'] ?? null,
            notes: $data['notes'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'valuation_date' => $this->valuation_date,
            'product_id' => $this->product_id,
            'warehouse_id' => $this->warehouse_id,
            'quantity_on_hand' => $this->quantity_on_hand,
            'unit_cost' => $this->unit_cost,
            'total_value' => $this->total_value,
            'valuation_method' => $this->valuation_method,
            'notes' => $this->notes,
        ];
    }
}
