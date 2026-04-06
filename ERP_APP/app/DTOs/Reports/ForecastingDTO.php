<?php

namespace App\DTOs\Reports;

class ForecastingDTO
{
    public readonly ?string $forecast_name;
    public readonly ?string $forecast_type;
    public readonly ?string $period_type;
    public readonly ?string $start_date;
    public readonly ?string $end_date;
    public readonly ?string $base_data_source;
    public readonly ?string $status;

    public function __construct(array $data)
    {
        $this->forecast_name     = $data['forecast_name'] ?? $data['name'] ?? null;
        $this->forecast_type     = $data['forecast_type'] ?? $data['model_type'] ?? null;
        $this->period_type       = $data['period_type'] ?? null;
        $this->start_date        = $data['start_date'] ?? $data['period_from'] ?? null;
        $this->end_date          = $data['end_date'] ?? $data['period_to'] ?? null;
        $this->base_data_source  = $data['base_data_source'] ?? $data['data_source'] ?? null;
        $this->status            = $data['status'] ?? 'Draft';
    }
}