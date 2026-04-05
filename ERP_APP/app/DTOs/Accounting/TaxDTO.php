<?php

namespace App\DTOs\Accounting;

class TaxDTO
{
    public function __construct(
        public readonly string $tax_name,
        public readonly float $tax_rate,
        public readonly ?string $tax_type = null,
        public readonly ?string $description = null,
        public readonly ?string $status = 'Active',
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            tax_name: $data['tax_name'] ?? $data['name'],
            tax_rate: (float) ($data['tax_rate'] ?? $data['rate']),
            tax_type: $data['tax_type'] ?? $data['type'] ?? null,
            description: $data['description'] ?? null,
            status: $data['status'] ?? 'Active',
        );
    }

    public function toArray(): array
    {
        return [
            'tax_name' => $this->tax_name,
            'tax_rate' => $this->tax_rate,
            'tax_type' => $this->tax_type,
            'description' => $this->description,
            'status' => $this->status,
        ];
    }
}
