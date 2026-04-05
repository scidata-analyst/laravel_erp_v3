<?php

namespace App\DTOs\Purchase;

class PurchaseOrdersDTO
{
    public function __construct(
        public readonly int $supplier_id,
        public readonly string $order_date,
        public readonly ?string $expected_delivery = null,
        public readonly ?string $warehouse = null,
        public readonly ?string $payment_terms = null,
        public readonly float $total_amount = 0,
        public readonly ?string $status = 'pending',
        public readonly ?array $order_items = [],
        public readonly ?string $notes = null,
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            supplier_id: (int) $data['supplier_id'],
            order_date: $data['order_date'],
            expected_delivery: $data['expected_delivery'] ?? $data['expected_delivery_date'] ?? null,
            warehouse: $data['warehouse'] ?? null,
            payment_terms: $data['payment_terms'] ?? null,
            total_amount: (float) ($data['total_amount'] ?? 0),
            status: $data['status'] ?? 'pending',
            order_items: $data['order_items'] ?? $data['items'] ?? [],
            notes: $data['notes'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'supplier_id' => $this->supplier_id,
            'order_date' => $this->order_date,
            'expected_delivery' => $this->expected_delivery,
            'warehouse' => $this->warehouse,
            'payment_terms' => $this->payment_terms,
            'total_amount' => $this->total_amount,
            'status' => $this->status,
            'order_items' => $this->order_items,
            'notes' => $this->notes,
        ];
    }
}
