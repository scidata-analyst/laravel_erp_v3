<?php

namespace App\DTOs\Purchase;

class SuppliersDTO
{
    public function __construct(
        public readonly string $company_name,
        public readonly ?string $contact_person = null,
        public readonly ?string $email = null,
        public readonly ?string $phone = null,
        public readonly ?string $country = null,
        public readonly ?string $payment_terms = null,
        public readonly ?string $currency = null,
        public readonly ?string $address = null,
        public readonly ?string $status = 'active',
        public readonly ?int $rating = null,
        public readonly ?string $tax_id = null,
        public readonly ?string $website = null,
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            company_name: $data['company_name'] ?? $data['name'] ?? $data['supplier_name'],
            contact_person: $data['contact_person'] ?? null,
            email: $data['email'] ?? null,
            phone: $data['phone'] ?? null,
            country: $data['country'] ?? null,
            payment_terms: $data['payment_terms'] ?? null,
            currency: $data['currency'] ?? null,
            address: $data['address'] ?? null,
            status: $data['status'] ?? 'active',
            rating: isset($data['rating']) ? (int) $data['rating'] : null,
            tax_id: $data['tax_id'] ?? null,
            website: $data['website'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'company_name' => $this->company_name,
            'contact_person' => $this->contact_person,
            'email' => $this->email,
            'phone' => $this->phone,
            'country' => $this->country,
            'payment_terms' => $this->payment_terms,
            'currency' => $this->currency,
            'address' => $this->address,
            'status' => $this->status,
            'rating' => $this->rating,
            'tax_id' => $this->tax_id,
            'website' => $this->website,
        ];
    }
}
