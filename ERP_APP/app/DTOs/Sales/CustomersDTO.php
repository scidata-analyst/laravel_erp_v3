<?php

namespace App\DTOs\Sales;

class CustomersDTO
{
    public function __construct(
        public readonly string $company_name,
        public readonly ?string $contact_person = null,
        public readonly ?string $email = null,
        public readonly ?string $phone = null,
        public readonly ?float $credit_limit = 0,
        public readonly ?string $sales_rep = null,
        public readonly ?string $billing_address = null,
        public readonly ?string $shipping_address = null,
        public readonly ?string $status = 'active',
        public readonly ?string $tax_id = null,
        public readonly ?string $payment_terms = null,
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            company_name: $data['company_name'] ?? $data['name'],
            contact_person: $data['contact_person'] ?? null,
            email: $data['email'] ?? null,
            phone: $data['phone'] ?? null,
            credit_limit: isset($data['credit_limit']) ? (float) $data['credit_limit'] : 0,
            sales_rep: $data['sales_rep'] ?? null,
            billing_address: $data['billing_address'] ?? null,
            shipping_address: $data['shipping_address'] ?? null,
            status: $data['status'] ?? 'active',
            tax_id: $data['tax_id'] ?? null,
            payment_terms: $data['payment_terms'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'company_name' => $this->company_name,
            'contact_person' => $this->contact_person,
            'email' => $this->email,
            'phone' => $this->phone,
            'credit_limit' => $this->credit_limit,
            'sales_rep' => $this->sales_rep,
            'billing_address' => $this->billing_address,
            'shipping_address' => $this->shipping_address,
            'status' => $this->status,
            'tax_id' => $this->tax_id,
            'payment_terms' => $this->payment_terms,
        ];
    }
}
