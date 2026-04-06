<?php

namespace App\DTOs\Sales;

class SalesOrdersDTO
{
    public readonly int $customer_id;
    public readonly string $order_date;
    public readonly ?string $delivery_date;
    public readonly ?string $payment_terms;
    public readonly ?float $discount;
    public readonly float $total_amount;
    public readonly ?string $status;
    public readonly ?array $order_items;
    public readonly ?string $notes;

    public function __construct(array $data)
    {
        $this->customer_id = (int) ($data['customer_id'] ?? 0);
        $this->order_date = $data['order_date'] ?? '';
        $this->delivery_date = $data['delivery_date'] ?? null;
        $this->payment_terms = $data['payment_terms'] ?? null;
        $this->discount = isset($data['discount']) ? (float) $data['discount'] : 0;
        $this->total_amount = (float) ($data['total_amount'] ?? 0);
        $this->status = $data['status'] ?? 'pending';
        $this->order_items = $data['order_items'] ?? $data['items'] ?? [];
        $this->notes = $data['notes'] ?? null;
    }
}