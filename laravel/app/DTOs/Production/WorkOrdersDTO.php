<?php

namespace App\DTOs\Production;

use App\Models\Production\WorkOrders;

/**
 * Data Transfer Object for WorkOrders entity.
 *
 * Used for type-safe data transfer between layers
 * and encapsulates production work order data.
 *
 * @property int|null $id
 * @property int|null $bomId
 * @property int|null $quantityToProduce
 * @property string|null $priority
 * @property string|null $startDate
 * @property string|null $endDate
 * @property string|null $workshopLine
 * @property int|null $status
 * @property string|null $createdAt
 * @property string|null $updatedAt
 * @property BomDTO|null $bom
 */
class WorkOrdersDTO
{
    /** @var int|null Unique identifier */
    public ?int $id;

    /** @var int|null Foreign key to bill_of_materials table */
    public ?int $bomId;

    /** @var int|null Quantity to produce */
    public ?int $quantityToProduce;

    /** @var string|null Priority level (e.g., 'Low', 'Medium', 'High', 'Urgent') */
    public ?string $priority;

    /** @var string|null Production start date (Y-m-d) */
    public ?string $startDate;

    /** @var string|null Expected completion date (Y-m-d) */
    public ?string $endDate;

    /** @var string|null Workshop/Production line */
    public ?string $workshopLine;

    /** @var int|null Status: 0=Pending, 1=InProgress, 2=Completed, 3=Cancelled */
    public ?int $status;

    /** @var string|null Creation timestamp (ISO 8601) */
    public ?string $createdAt;

    /** @var string|null Last update timestamp (ISO 8601) */
    public ?string $updatedAt;

    /** @var BomDTO|null Related Bill of Materials */
    public ?BomDTO $bom;

    /**
     * Create a new WorkOrdersDTO instance.
     *
     * @param array $data Optional data array for initialization
     */
    public function __construct(array $data = [])
    {
        $this->id = isset($data['id']) ? (int) $data['id'] : null;
        $this->bomId = isset($data['bom_id']) ? (int) $data['bom_id'] : null;
        $this->quantityToProduce = isset($data['quantity_to_produce']) ? (int) $data['quantity_to_produce'] : null;
        $this->priority = $data['priority'] ?? null;
        $this->startDate = $data['start_date'] ?? null;
        $this->endDate = $data['end_date'] ?? null;
        $this->workshopLine = $data['workshop_line'] ?? null;
        $this->status = isset($data['status']) ? (int) $data['status'] : null;
        $this->createdAt = $data['created_at'] ?? null;
        $this->updatedAt = $data['updated_at'] ?? null;
        $this->bom = $data['bom'] ?? null;
    }

    /**
     * Create DTO from Eloquent model instance.
     *
     * @param WorkOrders $model Eloquent model to convert
     * @return self New DTO instance with model data
     */
    public static function fromModel(WorkOrders $model): self
    {
        $data = [
            'id' => $model->id,
            'bom_id' => $model->bom_id,
            'quantity_to_produce' => $model->quantity_to_produce,
            'priority' => $model->priority,
            'start_date' => $model->start_date,
            'end_date' => $model->end_date,
            'workshop_line' => $model->workshop_line,
            'status' => $model->status,
            'created_at' => $model->created_at?->toIso8601String(),
            'updated_at' => $model->updated_at?->toIso8601String(),
        ];

        if ($model->relationLoaded('bom')) {
            $data['bom'] = BomDTO::fromModel($model->bom);
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
            'bom_id' => $this->bomId,
            'quantity_to_produce' => $this->quantityToProduce,
            'priority' => $this->priority,
            'start_date' => $this->startDate,
            'end_date' => $this->endDate,
            'workshop_line' => $this->workshopLine,
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
            'bom_id' => $this->bomId,
            'quantity_to_produce' => $this->quantityToProduce,
            'priority' => $this->priority,
            'start_date' => $this->startDate,
            'end_date' => $this->endDate,
            'workshop_line' => $this->workshopLine,
            'status' => $this->status,
        ];
    }
}
