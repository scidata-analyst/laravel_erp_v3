<?php

namespace App\DTOs\Purchase;

class SuppliersDTO
{
    public readonly ?string $supplier;
    public readonly ?string $contact_person;
    public readonly ?string $email;
    public readonly ?string $phone;
    public readonly ?string $country;
    public readonly ?string $payment_terms;
    public readonly ?string $currency;
    public readonly ?string $address;
    public readonly ?string $status;
    public readonly ?int $rating;

    public function __construct(array $data)
    {
        $this->supplier       = $data['supplier'] ?? null;
        $this->contact_person = $data['contact_person'] ?? null;
        $this->email          = $data['email'] ?? null;
        $this->phone          = $data['phone'] ?? null;
        $this->country        = $data['country'] ?? null;
        $this->payment_terms  = $data['payment_terms'] ?? null;
        $this->currency       = $data['currency'] ?? null;
        $this->address        = $data['address'] ?? null;
        $this->status         = $data['status'] ?? null;
        $this->rating         = isset($data['rating']) ? (int)$data['rating'] : null;
    }
}