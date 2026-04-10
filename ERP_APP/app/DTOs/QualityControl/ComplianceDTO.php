<?php

namespace App\DTOs\QualityControl;

use App\Models\QualityControl\Compliance;

/**
 * Data Transfer Object for Compliance entity.
 *
 * Used for type-safe data transfer between layers
 * and encapsulates regulatory compliance audit data.
 *
 * @property int|null $id
 * @property string|null $standardRegulation
 * @property string|null $scope
 * @property string|null $auditDate
 * @property string|null $nextAuditDate
 * @property string|null $auditor
 * @property string|null $findingsNotes
 * @property int|null $status
 * @property string|null $createdAt
 * @property string|null $updatedAt
 */
class ComplianceDTO
{
    /** @var int|null Unique identifier */
    public ?int $id;

    /** @var string|null Standard or regulation (e.g., 'ISO 9001', 'GMP', 'FDA') */
    public ?string $standardRegulation;

    /** @var string|null Scope of compliance (e.g., 'Production', 'Warehouse') */
    public ?string $scope;

    /** @var string|null Date of audit (Y-m-d) */
    public ?string $auditDate;

    /** @var string|null Next scheduled audit date (Y-m-d) */
    public ?string $nextAuditDate;

    /** @var string|null Auditor name */
    public ?string $auditor;

    /** @var string|null Findings and notes from audit */
    public ?string $findingsNotes;

    /** @var int|null Status: 0=Pending, 1=InProgress, 2=Compliant, 3=NonCompliant */
    public ?int $status;

    /** @var string|null Creation timestamp (ISO 8601) */
    public ?string $createdAt;

    /** @var string|null Last update timestamp (ISO 8601) */
    public ?string $updatedAt;

    /**
     * Create a new ComplianceDTO instance.
     *
     * @param array $data Optional data array for initialization
     */
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

    /**
     * Create DTO from Eloquent model instance.
     *
     * @param Compliance $model Eloquent model to convert
     * @return self New DTO instance with model data
     */
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

    /**
     * Create DTO from plain array data.
     *
     * @param array $data Associative array with DTO properties
     * @return self New DTO instance
     */
    public static function fromArray(array $data): self
    {
        return new self($data);
    }

    /**
     * Convert DTO to array representation.
     *
     * @return array Array with snake_case keys matching database columns
     */
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

    /**
     * Convert DTO to array for Eloquent model creation/update.
     *
     * Returns fillable attributes only, excluding timestamps
     * and foreign keys for related models.
     *
     * @return array Associative array for model mass assignment
     */
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
