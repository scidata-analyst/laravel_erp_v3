<?php

namespace App\DTOs\Purchase;

class GrnDTO
{
    public function __construct(
        public readonly int $purchase_order_id,
        public readonly ?string $grn_number = null,
        public readonly ?int $supplier_id = null,
        public readonly string $received_date,
        public readonly ?string $received_by = null,
        public readonly ?string $status = 'completed',
        public readonly ?string $notes = null,
        public readonly array $items = [],
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            purchase_order_id: (int) $data['purchase_order_id'],
            grn_number: $data['grn_number'] ?? null,
            supplier_id: isset($data['supplier_id']) ? (int) $data['supplier_id'] : null,
            received_date: $data['received_date'],
            received_by: $data['received_by'] ?? null,
            status: $data['status'] ?? 'completed',
            notes: $data['notes'] ?? null,
            items: $data['items'] ?? [],
        );
    }

    public function toArray(): array
    {
        return [
            'purchase_order_id' => $this->purchase_order_id,
            'grn_number' => $this->grn_number,
            'supplier_id' => $this->supplier_id,
            'received_date' => $this->received_date,
            'received_by' => $this->received_by,
            'status' => $this->status,
            'notes' => $this->notes,
        ];
    }
}
