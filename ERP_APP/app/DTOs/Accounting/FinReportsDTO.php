<?php

namespace App\DTOs\Accounting;

final class FinReportsDTO
{
    public readonly string $reportName;
    public readonly string $reportType;
    public readonly string $periodStart;
    public readonly string $periodEnd;
    public readonly ?string $generatedBy;
    public readonly ?string $status;
    public readonly ?array $parameters;

    public function __construct(array $data)
    {
        $this->reportName = (string)($data['report_name'] ?? '');
        $this->reportType = (string)($data['report_type'] ?? '');
        $this->periodStart = (string)($data['period_start'] ?? '');
        $this->periodEnd = (string)($data['period_end'] ?? '');
        $this->generatedBy = $data['generated_by'] ?? null;
        $this->status = (string)($data['status'] ?? 'draft');
        $this->parameters = $data['parameters'] ?? null;
    }
}