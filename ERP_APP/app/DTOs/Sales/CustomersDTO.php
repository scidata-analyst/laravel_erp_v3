<?php

namespace App\DTOs\Sales;

class CustomersDTO
{
    public readonly ?string $company_name;
    public readonly ?string $contact_person;
    public readonly ?string $email;
    public readonly ?string $phone;
    public readonly ?float $credit_limit;
    public readonly ?string $sales_rep;
    public readonly ?string $billing_address;
    public readonly ?string $shipping_address;
    public readonly ?string $status;
    public readonly ?string $tax_id;
    public readonly ?string $payment_terms;

    public function __construct(array $data)
    {
        $this->company_name      = $data['company_name'] ?? $data['name'] ?? null;
        $this->contact_person    = $data['contact_person'] ?? null;
        $this->email             = $data['email'] ?? null;
        $this->phone             = $data['phone'] ?? null;
        $this->credit_limit      = isset($data['credit_limit']) ? (float) $data['credit_limit'] : 0;
        $this->sales_rep         = $data['sales_rep'] ?? null;
        $this->billing_address   = $data['billing_address'] ?? null;
        $this->shipping_address  = $data['shipping_address'] ?? null;
        $this->status            = $data['status'] ?? 'active';
        $this->tax_id            = $data['tax_id'] ?? null;
        $this->payment_terms     = $data['payment_terms'] ?? null;
    }
}