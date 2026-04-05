<?php

namespace App\DTOs\Ecommerce;

class PosTransactionsDTO
{
    public function __construct(
        public readonly string $transaction_number,
        public readonly int $terminal_id,
        public readonly ?string $transaction_type = null,
        public readonly ?string $payment_method = null,
        public readonly ?float $amount = 0,
        public readonly ?float $tax_amount = 0,
        public readonly ?float $total_amount = 0,
        public readonly ?int $customer_id = null,
        public readonly ?string $order_reference = null,
        public readonly array $items = [],
        public readonly ?float $cash_tendered = null,
        public readonly ?float $change_given = null,
        public readonly ?string $transaction_date = null,
        public readonly ?string $status = null,
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            transaction_number: $data['transaction_number'],
            terminal_id: (int) ($data['terminal_id'] ?? $data['pos_id']),
            transaction_type: isset($data['transaction_type']) ? strtolower((string) $data['transaction_type']) : 'sale',
            payment_method: isset($data['payment_method']) ? strtolower((string) $data['payment_method']) : 'cash',
            amount: isset($data['amount']) ? (float) $data['amount'] : null,
            tax_amount: (float) ($data['tax_amount'] ?? 0),
            total_amount: (float) ($data['total_amount'] ?? 0),
            customer_id: isset($data['customer_id']) ? (int) $data['customer_id'] : null,
            order_reference: $data['order_reference'] ?? null,
            items: $data['items'] ?? [],
            cash_tendered: isset($data['cash_tendered']) ? (float) $data['cash_tendered'] : null,
            change_given: isset($data['change_given']) ? (float) $data['change_given'] : null,
            transaction_date: $data['transaction_date'] ?? null,
            status: isset($data['status']) ? strtolower((string) $data['status']) : 'completed',
        );
    }

    public function toArray(): array
    {
        return [
            'transaction_number' => $this->transaction_number,
            'terminal_id' => $this->terminal_id,
            'transaction_type' => $this->transaction_type,
            'payment_method' => $this->payment_method,
            'amount' => $this->amount,
            'tax_amount' => $this->tax_amount,
            'total_amount' => $this->total_amount,
            'customer_id' => $this->customer_id,
            'order_reference' => $this->order_reference,
            'items' => $this->items,
            'cash_tendered' => $this->cash_tendered,
            'change_given' => $this->change_given,
            'transaction_date' => $this->transaction_date,
            'status' => $this->status,
        ];
    }
}
