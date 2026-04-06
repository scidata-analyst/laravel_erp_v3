<?php

namespace App\DTOs\QualityControl;

class DefectsDTO
{
    public readonly ?string $defect_number;
    public readonly ?int $product_id;
    public readonly ?string $batch_number;
    public readonly ?string $defect_type;
    public readonly ?string $severity;
    public readonly ?string $description;
    public readonly ?int $reported_by;
    public readonly ?string $status;
    public readonly ?int $quantity_defective;

    public function __construct(array $data)
    {
        $this->defect_number      = $data['defect_number'] ?? null;
        $this->product_id         = isset($data['product_id']) ? (int)$data['product_id'] : null;
        $this->batch_number       = $data['batch_number'] ?? null;
        $this->defect_type        = $data['defect_type'] ?? null;
        $this->severity           = $data['severity'] ?? null;
        $this->description        = $data['description'] ?? null;
        $this->reported_by        = isset($data['reported_by']) ? (int)$data['reported_by'] : null;
        $this->status             = $data['status'] ?? null;
        $this->quantity_defective = isset($data['quantity_defective']) ? (int)$data['quantity_defective'] : null;
    }
}