<?php

namespace App\DTOs\Sales;

class InvoicesDTO
{
    public function __construct(
        public readonly ?int $customer_id = null,
        public readonly ?string $invoice_number = null,
        public readonly ?int $sales_order_id = null,
        public readonly string $invoice_date = '',
        public readonly ?string $due_date = null,
        public readonly float $amount = 0,
        public readonly float $tax = 0,
        public readonly float $paid_amount = 0,
        public readonly float $balance = 0,
        public readonly ?string $status = 'pending',
        public readonly ?string $notes = null,
    ) {}

    public static function fromRequest(array $data): self
    {
        $amount = (float) ($data['amount'] ?? $data['total_amount'] ?? 0);
        $tax = (float) ($data['tax'] ?? $data['tax_amount'] ?? 0);
        $paid = (float) ($data['paid_amount'] ?? 0);

        return new self(
            customer_id: isset($data['customer_id']) ? (int) $data['customer_id'] : null,
            invoice_number: $data['invoice_number'] ?? null,
            sales_order_id: isset($data['sales_order_id']) ? (int) $data['sales_order_id'] : (isset($data['sales_order_ref']) ? (int) $data['sales_order_ref'] : null),
            invoice_date: $data['invoice_date'] ?? '',
            due_date: $data['due_date'] ?? null,
            amount: $amount,
            tax: $tax,
            paid_amount: $paid,
            balance: (float) ($data['balance'] ?? max(0, $amount - $paid)),
            status: $data['status'] ?? 'pending',
            notes: $data['notes'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'customer_id' => $this->customer_id,
            'invoice_number' => $this->invoice_number,
            'sales_order_id' => $this->sales_order_id,
            'invoice_date' => $this->invoice_date,
            'due_date' => $this->due_date,
            'amount' => $this->amount,
            'tax' => $this->tax,
            'paid_amount' => $this->paid_amount,
            'balance' => $this->balance,
            'status' => $this->status,
            'notes' => $this->notes,
        ];
    }
}
