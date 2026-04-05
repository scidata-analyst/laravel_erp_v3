<?php

namespace App\DTOs\QualityControl;

class QcChecklistsDTO
{
    public function __construct(
        public readonly ?string $checklist_number = null,
        public readonly ?int $work_order_id = null,
        public readonly ?string $name = null,
        public readonly ?int $inspector_id = null,
        public readonly ?string $inspection_type = null,
        public readonly ?string $inspection_date = null,
        public readonly ?int $sample_size = null,
        public readonly ?int $items_checked = null,
        public readonly ?int $items_passed = null,
        public readonly ?float $pass_rate = null,
        public readonly ?string $status = 'pending',
        public readonly mixed $checklist_items = null,
        public readonly mixed $criteria = null,
        public readonly ?string $notes = null,
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            checklist_number: $data['checklist_number'] ?? $data['checklist_name'] ?? null,
            work_order_id: isset($data['work_order_id']) ? (int) $data['work_order_id'] : null,
            name: $data['name'] ?? $data['checklist_name'] ?? null,
            inspector_id: isset($data['inspector_id']) ? (int) $data['inspector_id'] : null,
            inspection_type: $data['inspection_type'] ?? $data['category'] ?? null,
            inspection_date: $data['inspection_date'] ?? null,
            sample_size: isset($data['sample_size']) ? (int) $data['sample_size'] : null,
            items_checked: isset($data['items_checked']) ? (int) $data['items_checked'] : null,
            items_passed: isset($data['items_passed']) ? (int) $data['items_passed'] : null,
            pass_rate: isset($data['pass_rate']) ? (float) $data['pass_rate'] : null,
            status: isset($data['status']) ? strtolower((string) $data['status']) : 'pending',
            checklist_items: $data['checklist_items'] ?? $data['items'] ?? null,
            criteria: $data['criteria'] ?? null,
            notes: $data['notes'] ?? $data['description'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'checklist_number' => $this->checklist_number,
            'work_order_id' => $this->work_order_id,
            'name' => $this->name,
            'inspector_id' => $this->inspector_id,
            'inspection_type' => $this->inspection_type,
            'inspection_date' => $this->inspection_date,
            'sample_size' => $this->sample_size,
            'items_checked' => $this->items_checked,
            'items_passed' => $this->items_passed,
            'pass_rate' => $this->pass_rate,
            'status' => $this->status,
            'checklist_items' => $this->checklist_items,
            'criteria' => $this->criteria,
            'notes' => $this->notes,
        ];
    }
}
