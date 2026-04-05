<?php

namespace App\DTOs\Inventory;

class StockMovementsDTO
{
    public function __construct(
        public readonly int $product_id,
        public readonly string $movement_type,
        public readonly float $quantity,
        public readonly ?string $from_warehouse = null,
        public readonly ?string $to_warehouse = null,
        public readonly ?string $ref_number = null,
        public readonly ?string $reason_notes = null,
        public readonly ?int $user_id = null,
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            product_id: (int) $data['product_id'],
            movement_type: $data['movement_type'],
            quantity: (float) $data['quantity'],
            from_warehouse: $data['from_warehouse'] ?? null,
            to_warehouse: $data['to_warehouse'] ?? null,
            ref_number: $data['ref_number'] ?? $data['reference_number'] ?? null,
            reason_notes: $data['reason_notes'] ?? $data['remarks'] ?? $data['reason'] ?? null,
            user_id: isset($data['user_id']) ? (int) $data['user_id'] : null,
        );
    }

    public function toArray(): array
    {
        return [
            'product_id' => $this->product_id,
            'movement_type' => $this->movement_type,
            'quantity' => $this->quantity,
            'from_warehouse' => $this->from_warehouse,
            'to_warehouse' => $this->to_warehouse,
            'ref_number' => $this->ref_number,
            'reason_notes' => $this->reason_notes,
            'user_id' => $this->user_id,
        ];
    }
}
