<?php

namespace App\DTOs\QualityControl;

class ComplianceDTO
{
    public readonly ?string $report_number;
    public readonly ?string $standard_name;
    public readonly ?string $scope;
    public readonly ?string $audit_date;
    public readonly ?string $next_audit_date;
    public readonly ?int $auditor_id;
    public readonly ?string $findings;
    public readonly ?string $status;
    public readonly ?string $notes;

    public function __construct(array $data)
    {
        $this->report_number   = $data['report_number'] ?? null;
        $this->standard_name   = $data['standard_name'] ?? null;
        $this->scope           = $data['scope'] ?? null;
        $this->audit_date      = $data['audit_date'] ?? null;
        $this->next_audit_date = $data['next_audit_date'] ?? null;
        $this->auditor_id      = isset($data['auditor_id']) ? (int)$data['auditor_id'] : null;
        $this->findings        = $data['findings'] ?? null;
        $this->status          = $data['status'] ?? null;
        $this->notes           = $data['notes'] ?? null;
    }
}