<?php

namespace App\DTOs\QualityControl;

use App\DTOs\UsersRoles\UserDTO;
use App\Models\QualityControl\QcChecklists;

class QcChecklistsDTO
{
    public ?int $id;

    public ?string $productBatchWorkOrder;

    public ?int $inspectorId;

    public ?string $inspectionType;

    public ?string $inspectionDate;

    public ?int $sampleSize;

    public ?string $checklistItemsNotes;

    public ?int $status;

    public ?string $createdAt;

    public ?string $updatedAt;

    public ?UserDTO $inspector;

    public function __construct(array $data = [])
    {
        $this->id = isset($data['id']) ? (int) $data['id'] : null;
        $this->productBatchWorkOrder = $data['product_batch_work_order'] ?? null;
        $this->inspectorId = isset($data['inspector_id']) ? (int) $data['inspector_id'] : null;
        $this->inspectionType = $data['inspection_type'] ?? null;
        $this->inspectionDate = $data['inspection_date'] ?? null;
        $this->sampleSize = isset($data['sample_size']) ? (int) $data['sample_size'] : null;
        $this->checklistItemsNotes = $data['checklist_items_notes'] ?? null;
        $this->status = isset($data['status']) ? (int) $data['status'] : null;
        $this->createdAt = $data['created_at'] ?? null;
        $this->updatedAt = $data['updated_at'] ?? null;
        $this->inspector = $data['inspector'] ?? null;
    }

    public static function fromModel(QcChecklists $model): self
    {
        $data = [
            'id' => $model->id,
            'product_batch_work_order' => $model->product_batch_work_order,
            'inspector_id' => $model->inspector_id,
            'inspection_type' => $model->inspection_type,
            'inspection_date' => $model->inspection_date,
            'sample_size' => $model->sample_size,
            'checklist_items_notes' => $model->checklist_items_notes,
            'status' => $model->status,
            'created_at' => $model->created_at?->toIso8601String(),
            'updated_at' => $model->updated_at?->toIso8601String(),
        ];

        if ($model->relationLoaded('inspector')) {
            $data['inspector'] = UserDTO::fromModel($model->inspector);
        }

        return new self($data);
    }

    public static function fromArray(array $data): self
    {
        return new self($data);
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'product_batch_work_order' => $this->productBatchWorkOrder,
            'inspector_id' => $this->inspectorId,
            'inspection_type' => $this->inspectionType,
            'inspection_date' => $this->inspectionDate,
            'sample_size' => $this->sampleSize,
            'checklist_items_notes' => $this->checklistItemsNotes,
            'status' => $this->status,
            'created_at' => $this->createdAt,
            'updated_at' => $this->updatedAt,
        ];
    }

    public function toModel(): array
    {
        return [
            'product_batch_work_order' => $this->productBatchWorkOrder,
            'inspector_id' => $this->inspectorId,
            'inspection_type' => $this->inspectionType,
            'inspection_date' => $this->inspectionDate,
            'sample_size' => $this->sampleSize,
            'checklist_items_notes' => $this->checklistItemsNotes,
            'status' => $this->status,
        ];
    }
}
