<?php

namespace App\DTOs\Reports;

class ForecastingDTO
{
    public function __construct(
        public readonly string $forecast_name,
        public readonly string $forecast_type,
        public readonly ?string $period_type = null,
        public readonly ?string $start_date = null,
        public readonly ?string $end_date = null,
        public readonly ?string $base_data_source = null,
        public readonly ?string $status = 'Draft',
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            forecast_name: $data['forecast_name'] ?? $data['name'],
            forecast_type: $data['forecast_type'] ?? $data['model_type'],
            period_type: $data['period_type'] ?? null,
            start_date: $data['start_date'] ?? $data['period_from'] ?? null,
            end_date: $data['end_date'] ?? $data['period_to'] ?? null,
            base_data_source: $data['base_data_source'] ?? $data['data_source'] ?? null,
            status: $data['status'] ?? 'Draft',
        );
    }

    public function toArray(): array
    {
        return [
            'forecast_name' => $this->forecast_name,
            'forecast_type' => $this->forecast_type,
            'period_type' => $this->period_type,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'base_data_source' => $this->base_data_source,
            'status' => $this->status,
        ];
    }
}
