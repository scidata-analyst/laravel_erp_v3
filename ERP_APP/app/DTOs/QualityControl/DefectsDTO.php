<?php

namespace App\DTOs\QualityControl;

use App\DTOs\Inventory\ProductCatalogDTO;
use App\Models\QualityControl\Defects;

/**
 * Data Transfer Object for Defects entity.
 *
 * Used for type-safe data transfer between layers
 * and encapsulates quality defect tracking data.
 *
 * @property int|null $id
 * @property int|null $productId
 * @property string|null $batchLotNumber
 * @property string|null $defectType
 * @property string|null $severity
 * @property int|null $quantityAffected
 * @property string|null $descriptionRootCause
 * @property int|null $status
 * @property string|null $createdAt
 * @property string|null $updatedAt
 * @property ProductCatalogDTO|null $product
 */
class DefectsDTO
{
    /** @var int|null Unique identifier */
    public ?int $id;

    /** @var int|null Foreign key to products table */
    public ?int $productId;

    /** @var string|null Batch/Lot number where defect was found */
    public ?string $batchLotNumber;

    /** @var string|null Type of defect (e.g., 'Dimensional', 'Functional', 'Cosmetic') */
    public ?string $defectType;

    /** @var string|null Severity level (e.g., 'Critical', 'Major', 'Minor') */
    public ?string $severity;

    /** @var int|null Number of units affected */
    public ?int $quantityAffected;

    /** @var string|null Description and root cause analysis */
    public ?string $descriptionRootCause;

    /** @var int|null Status: 0=Open, 1=UnderInvestigation, 2=Resolved, 3=Closed */
    public ?int $status;

    /** @var string|null Creation timestamp (ISO 8601) */
    public ?string $createdAt;

    /** @var string|null Last update timestamp (ISO 8601) */
    public ?string $updatedAt;

    /** @var ProductCatalogDTO|null Related product */
    public ?ProductCatalogDTO $product;

    /**
     * Create a new DefectsDTO instance.
     *
     * @param array $data Optional data array for initialization
     */
    public function __construct(array $data = [])
    {
        $this->id = isset($data['id']) ? (int) $data['id'] : null;
        $this->productId = isset($data['product_id']) ? (int) $data['product_id'] : null;
        $this->batchLotNumber = $data['batch_lot_number'] ?? null;
        $this->defectType = $data['defect_type'] ?? null;
        $this->severity = $data['severity'] ?? null;
        $this->quantityAffected = isset($data['quantity_affected']) ? (int) $data['quantity_affected'] : null;
        $this->descriptionRootCause = $data['description_root_cause'] ?? null;
        $this->status = isset($data['status']) ? (int) $data['status'] : null;
        $this->createdAt = $data['created_at'] ?? null;
        $this->updatedAt = $data['updated_at'] ?? null;
        $this->product = $data['product'] ?? null;
    }

    /**
     * Create DTO from Eloquent model instance.
     *
     * @param Defects $model Eloquent model to convert
     * @return self New DTO instance with model data
     */
    public static function fromModel(Defects $model): self
    {
        $data = [
            'id' => $model->id,
            'product_id' => $model->product_id,
            'batch_lot_number' => $model->batch_lot_number,
            'defect_type' => $model->defect_type,
            'severity' => $model->severity,
            'quantity_affected' => $model->quantity_affected,
            'description_root_cause' => $model->description_root_cause,
            'status' => $model->status,
            'created_at' => $model->created_at?->toIso8601String(),
            'updated_at' => $model->updated_at?->toIso8601String(),
        ];

        if ($model->relationLoaded('product')) {
            $data['product'] = ProductCatalogDTO::fromModel($model->product);
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
            'product_id' => $this->productId,
            'batch_lot_number' => $this->batchLotNumber,
            'defect_type' => $this->defectType,
            'severity' => $this->severity,
            'quantity_affected' => $this->quantityAffected,
            'description_root_cause' => $this->descriptionRootCause,
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
            'product_id' => $this->productId,
            'batch_lot_number' => $this->batchLotNumber,
            'defect_type' => $this->defectType,
            'severity' => $this->severity,
            'quantity_affected' => $this->quantityAffected,
            'description_root_cause' => $this->descriptionRootCause,
            'status' => $this->status,
        ];
    }
}
