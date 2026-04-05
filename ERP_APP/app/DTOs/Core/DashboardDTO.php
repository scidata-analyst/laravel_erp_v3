<?php

namespace App\DTOs\Core;

class DashboardDTO
{
    public function __construct(
        public readonly string $metric_name,
        public readonly mixed $metric_value,
        public readonly ?string $category = 'General',
        public readonly ?string $period = 'Daily',
        public readonly ?array $extra_data = null
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            metric_name: $data['metric_name'],
            metric_value: $data['metric_value'],
            category: $data['category'] ?? 'General',
            period: $data['period'] ?? 'Daily',
            extra_data: $data['extra_data'] ?? null
        );
    }

    public function toArray(): array
    {
        return [
            'metric_name' => $this->metric_name,
            'metric_value' => $this->metric_value,
            'category' => $this->category,
            'period' => $this->period,
            'extra_data' => $this->extra_data,
        ];
    }
}
