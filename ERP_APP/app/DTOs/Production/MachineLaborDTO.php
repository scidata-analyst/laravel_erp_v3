<?php

namespace App\DTOs\Production;

class MachineLaborDTO
{
    public function __construct(
        public readonly int $work_order_id,
        public readonly ?string $resource_type = null,
        public readonly ?string $resource_name = null,
        public readonly ?float $hours = null,
        public readonly ?float $rate = null,
        public readonly ?string $notes = null,
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            work_order_id: (int) $data['work_order_id'],
            resource_type: $data['resource_type'] ?? null,
            resource_name: $data['resource_name'] ?? null,
            hours: isset($data['hours']) ? (float) $data['hours'] : (isset($data['hours_spent']) ? (float) $data['hours_spent'] : null),
            rate: isset($data['rate']) ? (float) $data['rate'] : (isset($data['hourly_rate']) ? (float) $data['hourly_rate'] : null),
            notes: $data['notes'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'work_order_id' => $this->work_order_id,
            'resource_type' => $this->resource_type,
            'resource_name' => $this->resource_name,
            'hours' => $this->hours,
            'rate' => $this->rate,
            'notes' => $this->notes,
        ];
    }
}
