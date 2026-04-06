<?php

namespace App\DTOs\Accounting;

final class TaxDTO
{
    public readonly string $taxName;
    public readonly float $taxRate;
    public readonly ?string $taxType;
    public readonly ?string $description;
    public readonly ?string $status;

    public function __construct(array $data)
    {
        $this->taxName = (string)($data['tax_name'] ?? $data['name'] ?? '');
        $this->taxRate = (float)($data['tax_rate'] ?? $data['rate'] ?? 0);
        $this->taxType = $data['tax_type'] ?? $data['type'] ?? null;
        $this->description = $data['description'] ?? null;
        $this->status = (string)($data['status'] ?? 'Active');
    }
}