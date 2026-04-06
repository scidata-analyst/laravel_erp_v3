<?php

namespace App\DTOs\Purchase;

class SupplierPaymentsDTO
{
    public readonly ?string $payment_number;
    public readonly ?int $supplier_id;
    public readonly ?int $purchase_order_id;
    public readonly ?string $payment_date;
    public readonly ?float $amount;
    public readonly ?string $payment_method;
    public readonly ?string $reference;
    public readonly ?string $status;
    public readonly ?string $notes;
    public readonly ?int $approved_by;

    public function __construct(array $data)
    {
        $this->payment_number     = $data['payment_number'] ?? null;
        $this->supplier_id        = isset($data['supplier_id']) ? (int)$data['supplier_id'] : null;
        $this->purchase_order_id  = isset($data['purchase_order_id']) ? (int)$data['purchase_order_id'] : null;
        $this->payment_date       = $data['payment_date'] ?? null;
        $this->amount             = isset($data['amount']) ? (float)$data['amount'] : null;
        $this->payment_method     = $data['payment_method'] ?? null;
        $this->reference          = $data['reference'] ?? null;
        $this->status             = $data['status'] ?? null;
        $this->notes              = $data['notes'] ?? null;
        $this->approved_by        = isset($data['approved_by']) ? (int)$data['approved_by'] : null;
    }
}