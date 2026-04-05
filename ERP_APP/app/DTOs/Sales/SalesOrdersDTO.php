<?php

namespace App\DTOs\Sales;

class SalesOrdersDTO
{
    public function __construct(
        public readonly int $customer_id,
        public readonly string $order_date,
        public readonly ?string $delivery_date = null,
        public readonly ?string $payment_terms = null,
        public readonly ?float $discount = 0,
        public readonly float $total_amount = 0,
        public readonly ?string $status = 'pending',
        public readonly ?array $order_items = [],
        public readonly ?string $notes = null,
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            customer_id: (int) $data['customer_id'],
            order_date: $data['order_date'],
            delivery_date: $data['delivery_date'] ?? null,
            payment_terms: $data['payment_terms'] ?? null,
            discount: isset($data['discount']) ? (float) $data['discount'] : 0,
            total_amount: (float) ($data['total_amount'] ?? 0),
            status: $data['status'] ?? 'pending',
            order_items: $data['order_items'] ?? $data['items'] ?? [],
            notes: $data['notes'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'customer_id' => $this->customer_id,
            'order_date' => $this->order_date,
            'delivery_date' => $this->delivery_date,
            'payment_terms' => $this->payment_terms,
            'discount' => $this->discount,
            'total_amount' => $this->total_amount,
            'status' => $this->status,
            'order_items' => $this->order_items,
            'notes' => $this->notes,
        ];
    }
}
