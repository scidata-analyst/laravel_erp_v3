<?php

namespace App\DTOs\Purchase;

class SupplierPaymentsDTO
{
    public function __construct(
        public readonly int $supplier_id,
        public readonly ?int $purchase_order_id,
        public readonly ?string $payment_number = null,
        public readonly string $payment_date,
        public readonly float $amount,
        public readonly string $payment_method,
        public readonly ?string $reference_number = null,
        public readonly ?string $status = 'completed',
        public readonly ?string $notes = null,
        public readonly ?int $approved_by = null,
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            supplier_id: (int) $data['supplier_id'],
            purchase_order_id: isset($data['purchase_order_id']) && $data['purchase_order_id'] !== '' ? (int) $data['purchase_order_id'] : null,
            payment_number: $data['payment_number'] ?? $data['payment_ref'] ?? null,
            payment_date: $data['payment_date'],
            amount: (float) ($data['amount'] ?? $data['amount_paid']),
            payment_method: $data['payment_method'],
            reference_number: $data['reference_number'] ?? $data['reference'] ?? $data['transaction_id'] ?? null,
            status: $data['status'] ?? 'completed',
            notes: $data['notes'] ?? null,
            approved_by: isset($data['approved_by']) ? (int) $data['approved_by'] : null,
        );
    }

    public function toArray(): array
    {
        return [
            'supplier_id' => $this->supplier_id,
            'purchase_order_id' => $this->purchase_order_id,
            'payment_number' => $this->payment_number,
            'payment_date' => $this->payment_date,
            'amount' => $this->amount,
            'payment_method' => $this->payment_method,
            'reference_number' => $this->reference_number,
            'status' => $this->status,
            'notes' => $this->notes,
            'approved_by' => $this->approved_by,
        ];
    }
}
