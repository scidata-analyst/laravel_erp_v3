<?php

namespace App\DTOs\Purchase;

class PurchaseOrdersDTO
{
    public readonly ?string $po_number;
    public readonly ?int $supplier_id;
    public readonly ?string $order_date;
    public readonly ?string $expected_delivery;
    public readonly ?string $warehouse;
    public readonly ?string $payment_terms;
    public readonly ?float $total_amount;
    public readonly ?string $status;
    public readonly ?string $approved_by;
    public readonly ?string $order_items;
    public readonly ?string $notes;

    public function __construct(array $data)
    {
        $this->po_number        = $data['po_number'] ?? null;
        $this->supplier_id      = isset($data['supplier_id']) ? (int)$data['supplier_id'] : null;
        $this->order_date       = $data['order_date'] ?? null;
        $this->expected_delivery= $data['expected_delivery'] ?? null;
        $this->warehouse        = $data['warehouse'] ?? null;
        $this->payment_terms    = $data['payment_terms'] ?? null;
        $this->total_amount     = isset($data['total_amount']) ? (float)$data['total_amount'] : null;
        $this->status           = $data['status'] ?? null;
        $this->approved_by      = $data['approved_by'] ?? null;
        $this->order_items      = $data['order_items'] ?? null;
        $this->notes            = $data['notes'] ?? null;
    }
}