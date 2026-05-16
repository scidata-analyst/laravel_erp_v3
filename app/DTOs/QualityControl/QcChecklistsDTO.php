<?php

namespace App\DTOs\QualityControl;

use App\DTOs\UsersRoles\UserDTO;
use App\Models\QualityControl\QcChecklists;

/**
 * Data Transfer Object for QcChecklists entity.
 *
 * Used for type-safe data transfer between layers
 * and encapsulates quality control checklist data.
 *
 * @property int|null $id
 * @property string|null $productBatchWorkOrder
 * @property int|null $inspectorId
 * @property string|null $inspectionType
 * @property string|null $inspectionDate
 * @property int|null $sampleSize
 * @property string|null $checklistItemsNotes
 * @property int|null $status
 * @property string|null $createdAt
 * @property string|null $updatedAt
 * @property UserDTO|null $inspector
 */
class QcChecklistsDTO
{
    /** @var int|null Unique identifier */
    public ?int $id;

    /** @var string|null Reference to product batch or work order */
    public ?string $productBatchWorkOrder;

    /** @var int|null Foreign key to users table (inspector) */
    public ?int $inspectorId;

    /** @var string|null Type of inspection (e.g., 'Pre-Production', 'In-Process', 'Final') */
    public ?string $inspectionType;

    /** @var string|null Date of inspection (Y-m-d) */
    public ?string $inspectionDate;

    /** @var int|null Number of samples inspected */
    public ?int $sampleSize;

    /** @var string|null Checklist items and notes */
    public ?string $checklistItemsNotes;

    /** @var int|null Status: 0=Pending, 1=InProgress, 2=Passed, 3=Failed */
    public ?int $status;

    /** @var string|null Creation timestamp (ISO 8601) */
    public ?string $createdAt;

    /** @var string|null Last update timestamp (ISO 8601) */
    public ?string $updatedAt;

    /** @var UserDTO|null Related inspector */
    public ?UserDTO $inspector;

    /**
     * Create a new QcChecklistsDTO instance.
     *
     * @param array $data Optional data array for initialization
     */
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

    /**
     * Create DTO from Eloquent model instance.
     *
     * @param QcChecklists $model Eloquent model to convert
     * @return self New DTO instance with model data
     */
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
