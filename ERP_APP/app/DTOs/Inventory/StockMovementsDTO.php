<?php

namespace App\DTOs\Inventory;

class StockMovementsDTO
{
    public readonly int $product_id;
    public readonly string $movement_type;
    public readonly float $quantity;
    public readonly ?string $from_warehouse;
    public readonly ?string $to_warehouse;
    public readonly ?string $ref_number;
    public readonly ?string $reason_notes;
    public readonly ?int $user_id;

    public function __construct(array $data)
    {
        $this->product_id = (int)($data['product_id'] ?? 0);
        $this->movement_type = $data['movement_type'] ?? '';
        $this->quantity = isset($data['quantity']) ? (float)$data['quantity'] : 0;
        $this->from_warehouse = $data['from_warehouse'] ?? null;
        $this->to_warehouse = $data['to_warehouse'] ?? null;
        $this->ref_number = $data['ref_number'] ?? $data['reference_number'] ?? null;
        $this->reason_notes = $data['reason_notes'] ?? $data['remarks'] ?? $data['reason'] ?? null;
        $this->user_id = isset($data['user_id']) ? (int)$data['user_id'] : null;
    }
}