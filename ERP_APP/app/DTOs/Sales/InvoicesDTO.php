<?php

namespace App\DTOs\Sales;

class InvoicesDTO
{
    public readonly ?int $customer_id;
    public readonly ?string $invoice_number;
    public readonly ?int $sales_order_id;
    public readonly string $invoice_date;
    public readonly ?string $due_date;
    public readonly float $amount;
    public readonly float $tax;
    public readonly float $paid_amount;
    public readonly float $balance;
    public readonly ?string $status;
    public readonly ?string $notes;

    public function __construct(array $data)
    {
        $this->customer_id     = isset($data['customer_id']) ? (int) $data['customer_id'] : null;
        $this->invoice_number  = $data['invoice_number'] ?? null;
        $this->sales_order_id  = isset($data['sales_order_id']) ? (int) $data['sales_order_id'] : (isset($data['sales_order_ref']) ? (int) $data['sales_order_ref'] : null);
        $this->invoice_date    = $data['invoice_date'] ?? '';
        $this->due_date        = $data['due_date'] ?? null;
        $this->amount          = isset($data['amount']) ? (float) $data['amount'] : (isset($data['total_amount']) ? (float) $data['total_amount'] : 0);
        $this->tax             = isset($data['tax']) ? (float) $data['tax'] : (isset($data['tax_amount']) ? (float) $data['tax_amount'] : 0);
        $this->paid_amount     = isset($data['paid_amount']) ? (float) $data['paid_amount'] : 0;
        $this->balance         = isset($data['balance']) ? (float) $data['balance'] : max(0, $this->amount - $this->paid_amount);
        $this->status          = $data['status'] ?? 'pending';
        $this->notes           = $data['notes'] ?? null;
    }
}