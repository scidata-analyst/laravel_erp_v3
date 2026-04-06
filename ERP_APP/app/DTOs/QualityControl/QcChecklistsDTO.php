<?php

namespace App\DTOs\QualityControl;

class QcChecklistsDTO
{
    public readonly ?string $checklist_number;
    public readonly ?int $product_id;
    public readonly ?int $inspector_id;
    public readonly ?string $inspection_type;
    public readonly ?string $inspection_date;
    public readonly ?int $sample_size;
    public readonly ?int $items_checked;
    public readonly ?int $items_passed;
    public readonly ?float $pass_rate;
    public readonly ?string $status;
    public readonly mixed $checklist_items;

    public function __construct(array $data)
    {
        $this->checklist_number = $data['checklist_number'] ?? null;
        $this->product_id       = isset($data['product_id']) ? (int)$data['product_id'] : null;
        $this->inspector_id     = isset($data['inspector_id']) ? (int)$data['inspector_id'] : null;
        $this->inspection_type  = $data['inspection_type'] ?? null;
        $this->inspection_date  = $data['inspection_date'] ?? null;
        $this->sample_size      = isset($data['sample_size']) ? (int)$data['sample_size'] : null;
        $this->items_checked    = isset($data['items_checked']) ? (int)$data['items_checked'] : null;
        $this->items_passed     = isset($data['items_passed']) ? (int)$data['items_passed'] : null;
        $this->pass_rate        = isset($data['pass_rate']) ? (float)$data['pass_rate'] : null;
        $this->status           = $data['status'] ?? 'pending';
        $this->checklist_items  = $data['checklist_items'] ?? null;
    }
}