<?php

namespace App\DTOs\Reports;

class CustomReportsDTO
{
    public readonly ?string $report_name;
    public readonly ?string $report_type;
    public readonly ?string $query_sql;
    public readonly ?string $filter_by;
    public readonly ?string $schedule;
    public readonly ?string $format_type;
    public readonly ?string $description;
    public readonly ?string $status;

    public function __construct(array $data)
    {
        $this->report_name   = $data['report_name'] ?? $data['name'] ?? null;
        $this->report_type   = $data['report_type'] ?? $data['type'] ?? $data['module'] ?? null;
        $this->query_sql     = $data['query_sql'] ?? $data['query'] ?? null;
        $this->filter_by     = $data['filter_by'] ?? null;
        $this->schedule      = $data['schedule'] ?? null;
        $this->format_type   = $data['format_type'] ?? $data['format'] ?? null;
        $this->description   = $data['description'] ?? null;
        $this->status        = $data['status'] ?? 'Active';
    }
}