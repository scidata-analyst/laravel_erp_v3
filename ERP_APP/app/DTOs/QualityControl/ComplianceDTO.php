<?php

namespace App\DTOs\QualityControl;

class ComplianceDTO
{
    public function __construct(
        public readonly ?string $report_number = null,
        public readonly ?string $compliance_type = null,
        public readonly ?string $standard_reference = null,
        public readonly ?string $audit_date = null,
        public readonly ?int $auditor_id = null,
        public readonly mixed $findings = null,
        public readonly ?string $risk_level = null,
        public readonly mixed $corrective_actions = null,
        public readonly ?string $due_date = null,
        public readonly ?string $completion_date = null,
        public readonly ?string $status = 'pending',
        public readonly ?string $notes = null,
        public readonly mixed $attachments = null,
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            report_number: $data['report_number'] ?? null,
            compliance_type: $data['compliance_type'] ?? $data['category'] ?? $data['version'] ?? null,
            standard_reference: $data['standard_reference'] ?? $data['standard_name'] ?? null,
            audit_date: $data['audit_date'] ?? $data['effective_date'] ?? null,
            auditor_id: isset($data['auditor_id']) ? (int) $data['auditor_id'] : null,
            findings: $data['findings'] ?? null,
            risk_level: $data['risk_level'] ?? null,
            corrective_actions: $data['corrective_actions'] ?? null,
            due_date: $data['due_date'] ?? $data['expiry_date'] ?? null,
            completion_date: $data['completion_date'] ?? null,
            status: isset($data['status']) ? strtolower((string) $data['status']) : 'pending',
            notes: $data['notes'] ?? $data['description'] ?? null,
            attachments: $data['attachments'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'report_number' => $this->report_number,
            'compliance_type' => $this->compliance_type,
            'standard_reference' => $this->standard_reference,
            'audit_date' => $this->audit_date,
            'auditor_id' => $this->auditor_id,
            'findings' => $this->findings,
            'risk_level' => $this->risk_level,
            'corrective_actions' => $this->corrective_actions,
            'due_date' => $this->due_date,
            'completion_date' => $this->completion_date,
            'status' => $this->status,
            'notes' => $this->notes,
            'attachments' => $this->attachments,
        ];
    }
}
