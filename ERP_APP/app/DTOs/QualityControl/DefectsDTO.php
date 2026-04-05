<?php

namespace App\DTOs\QualityControl;

class DefectsDTO
{
    public function __construct(
        public readonly ?string $defect_number = null,
        public readonly ?int $product_id = null,
        public readonly ?string $batch_number = null,
        public readonly string $defect_type = '',
        public readonly string $severity = '',
        public readonly ?string $description = null,
        public readonly ?int $detected_by = null,
        public readonly ?string $detection_date = null,
        public readonly ?string $status = 'open',
        public readonly ?string $resolution = null,
        public readonly ?string $resolution_date = null,
        public readonly ?float $cost_impact = null,
        public readonly ?int $affected_quantity = null,
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            defect_number: $data['defect_number'] ?? null,
            product_id: isset($data['product_id']) ? (int) $data['product_id'] : null,
            batch_number: $data['batch_number'] ?? null,
            defect_type: $data['defect_type'],
            severity: $data['severity'],
            description: $data['description'] ?? null,
            detected_by: isset($data['detected_by']) ? (int) $data['detected_by'] : (isset($data['reported_by']) ? (int) $data['reported_by'] : null),
            detection_date: $data['detection_date'] ?? null,
            status: isset($data['status']) ? strtolower((string) $data['status']) : 'open',
            resolution: $data['resolution'] ?? null,
            resolution_date: $data['resolution_date'] ?? null,
            cost_impact: isset($data['cost_impact']) ? (float) $data['cost_impact'] : null,
            affected_quantity: isset($data['affected_quantity']) ? (int) $data['affected_quantity'] : null,
        );
    }

    public function toArray(): array
    {
        return [
            'defect_number' => $this->defect_number,
            'product_id' => $this->product_id,
            'batch_number' => $this->batch_number,
            'defect_type' => $this->defect_type,
            'severity' => $this->severity,
            'description' => $this->description,
            'detected_by' => $this->detected_by,
            'detection_date' => $this->detection_date,
            'status' => $this->status,
            'resolution' => $this->resolution,
            'resolution_date' => $this->resolution_date,
            'cost_impact' => $this->cost_impact,
            'affected_quantity' => $this->affected_quantity,
        ];
    }
}
