<?php

namespace App\DTOs\Reports;

class CustomReportsDTO
{
    public function __construct(
        public readonly string $report_name,
        public readonly string $report_type,
        public readonly ?string $query_sql = null,
        public readonly ?array $parameters = null,
        public readonly ?string $filter_by = null,
        public readonly ?string $schedule = null,
        public readonly ?string $format_type = null,
        public readonly ?string $description = null,
        public readonly ?string $status = 'Active',
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            report_name: $data['report_name'] ?? $data['name'],
            report_type: $data['report_type'] ?? $data['type'] ?? $data['module'],
            query_sql: $data['query_sql'] ?? $data['query'] ?? null,
            parameters: $data['parameters'] ?? $data['query_parameters'] ?? null,
            filter_by: $data['filter_by'] ?? null,
            schedule: $data['schedule'] ?? null,
            format_type: $data['format_type'] ?? $data['format'] ?? null,
            description: $data['description'] ?? null,
            status: $data['status'] ?? 'Active',
        );
    }

    public function toArray(): array
    {
        return [
            'report_name' => $this->report_name,
            'report_type' => $this->report_type,
            'query_sql' => $this->query_sql,
            'parameters' => $this->parameters,
            'filter_by' => $this->filter_by,
            'schedule' => $this->schedule,
            'format_type' => $this->format_type,
            'description' => $this->description,
            'status' => $this->status,
        ];
    }
}
