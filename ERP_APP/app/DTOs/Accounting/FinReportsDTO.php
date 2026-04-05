<?php

namespace App\DTOs\Accounting;

class FinReportsDTO
{
    public function __construct(
        public readonly string $report_name,
        public readonly string $report_type,
        public readonly string $period_start,
        public readonly string $period_end,
        public readonly ?string $generated_by = null,
        public readonly ?string $status = 'draft',
        public readonly ?array $parameters = null,
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            report_name: $data['report_name'] ?? $data['name'],
            report_type: $data['report_type'] ?? $data['type'],
            period_start: $data['period_start'] ?? $data['start_date'],
            period_end: $data['period_end'] ?? $data['end_date'],
            generated_by: $data['generated_by'] ?? null,
            status: $data['status'] ?? 'draft',
            parameters: $data['parameters'] ?? $data['report_data'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'report_name' => $this->report_name,
            'report_type' => $this->report_type,
            'period_start' => $this->period_start,
            'period_end' => $this->period_end,
            'generated_by' => $this->generated_by,
            'status' => $this->status,
            'parameters' => $this->parameters,
        ];
    }
}
