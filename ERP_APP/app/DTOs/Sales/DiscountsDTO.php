<?php

namespace App\DTOs\Sales;

class DiscountsDTO
{
    public function __construct(
        public readonly string $discount_name,
        public readonly string $discount_type,
        public readonly float $discount_value,
        public readonly ?float $min_amount = null,
        public readonly ?string $start_date = null,
        public readonly ?string $end_date = null,
        public readonly ?int $usage_limit = null,
        public readonly ?string $status = 'active',
        public readonly ?string $description = null,
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            discount_name: $data['discount_name'] ?? $data['name'] ?? $data['code'],
            discount_type: $data['discount_type'] ?? $data['type'],
            discount_value: (float) ($data['discount_value'] ?? $data['value']),
            min_amount: isset($data['min_amount']) ? (float) $data['min_amount'] : null,
            start_date: $data['start_date'] ?? $data['valid_from'] ?? null,
            end_date: $data['end_date'] ?? $data['valid_to'] ?? null,
            usage_limit: isset($data['usage_limit']) ? (int) $data['usage_limit'] : (isset($data['max_uses']) ? (int) $data['max_uses'] : null),
            status: $data['status'] ?? 'active',
            description: $data['description'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'discount_name' => $this->discount_name,
            'discount_type' => $this->discount_type,
            'discount_value' => $this->discount_value,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'usage_limit' => $this->usage_limit,
            'status' => $this->status,
            'description' => $this->description,
        ];
    }
}
