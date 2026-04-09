<?php

namespace App\DTOs\QualityControl;

use App\Models\QualityControl\Compliance;

class ComplianceDTO
{
    public ?int $id;

    public ?string $standardRegulation;

    public ?string $scope;

    public ?string $auditDate;

    public ?string $nextAuditDate;

    public ?string $auditor;

    public ?string $findingsNotes;

    public ?int $status;

    public ?string $createdAt;

    public ?string $updatedAt;

    public function __construct(array $data = [])
    {
        $this->id = isset($data['id']) ? (int) $data['id'] : null;
        $this->standardRegulation = $data['standard_regulation'] ?? null;
        $this->scope = $data['scope'] ?? null;
        $this->auditDate = $data['audit_date'] ?? null;
        $this->nextAuditDate = $data['next_audit_date'] ?? null;
        $this->auditor = $data['auditor'] ?? null;
        $this->findingsNotes = $data['findings_notes'] ?? null;
        $this->status = isset($data['status']) ? (int) $data['status'] : null;
        $this->createdAt = $data['created_at'] ?? null;
        $this->updatedAt = $data['updated_at'] ?? null;
    }

    public static function fromModel(Compliance $model): self
    {
        return new self([
            'id' => $model->id,
            'standard_regulation' => $model->standard_regulation,
            'scope' => $model->scope,
            'audit_date' => $model->audit_date,
            'next_audit_date' => $model->next_audit_date,
            'auditor' => $model->auditor,
            'findings_notes' => $model->findings_notes,
            'status' => $model->status,
            'created_at' => $model->created_at?->toIso8601String(),
            'updated_at' => $model->updated_at?->toIso8601String(),
        ]);
    }

    public static function fromArray(array $data): self
    {
        return new self($data);
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'standard_regulation' => $this->standardRegulation,
            'scope' => $this->scope,
            'audit_date' => $this->auditDate,
            'next_audit_date' => $this->nextAuditDate,
            'auditor' => $this->auditor,
            'findings_notes' => $this->findingsNotes,
            'status' => $this->status,
            'created_at' => $this->createdAt,
            'updated_at' => $this->updatedAt,
        ];
    }

    public function toModel(): array
    {
        return [
            'standard_regulation' => $this->standardRegulation,
            'scope' => $this->scope,
            'audit_date' => $this->auditDate,
            'next_audit_date' => $this->nextAuditDate,
            'auditor' => $this->auditor,
            'findings_notes' => $this->findingsNotes,
            'status' => $this->status,
        ];
    }
}
