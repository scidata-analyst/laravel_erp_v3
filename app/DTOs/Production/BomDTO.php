<?php

namespace App\DTOs\Production;

use App\Models\Production\Bom;

/**
 * Data Transfer Object for Bom (Bill of Materials) entity.
 *
 * Used for type-safe data transfer between layers
 * and encapsulates bill of materials data.
 *
 * @property int|null $id
 * @property string|null $finishedProductName
 * @property string|null $version
 * @property int|null $leadTimeDays
 * @property int|null $status
 * @property string|null $createdAt
 * @property string|null $updatedAt
 * @property array|null $workOrders
 */
class BomDTO
{
    /** @var int|null Unique identifier */
    public ?int $id;

    /** @var string|null Name of the finished product */
    public ?string $finishedProductName;

    /** @var string|null BOM version (e.g., '1.0', '2.1') */
    public ?string $version;

    /** @var int|null Lead time in days */
    public ?int $leadTimeDays;

    /** @var int|null Status: 0=Inactive, 1=Active, 2=UnderRevision */
    public ?int $status;

    /** @var string|null Creation timestamp (ISO 8601) */
    public ?string $createdAt;

    /** @var string|null Last update timestamp (ISO 8601) */
    public ?string $updatedAt;

    /** @var array|null Collection of related work orders */
    public ?array $workOrders;

    /**
     * Create a new BomDTO instance.
     *
     * @param array $data Optional data array for initialization
     */
    public function __construct(array $data = [])
    {
        $this->id = isset($data['id']) ? (int) $data['id'] : null;
        $this->finishedProductName = $data['finished_product_name'] ?? null;
        $this->version = $data['version'] ?? null;
        $this->leadTimeDays = isset($data['lead_time_days']) ? (int) $data['lead_time_days'] : null;
        $this->status = isset($data['status']) ? (int) $data['status'] : null;
        $this->createdAt = $data['created_at'] ?? null;
        $this->updatedAt = $data['updated_at'] ?? null;
        $this->workOrders = $data['workOrders'] ?? null;
    }

    /**
     * Create DTO from Eloquent model instance.
     *
     * @param Bom $model Eloquent model to convert
     * @return self New DTO instance with model data
     */
    public static function fromModel(Bom $model): self
    {
        $data = [
            'id' => $model->id,
            'finished_product_name' => $model->finished_product_name,
            'version' => $model->version,
            'lead_time_days' => $model->lead_time_days,
            'status' => $model->status,
            'created_at' => $model->created_at?->toIso8601String(),
            'updated_at' => $model->updated_at?->toIso8601String(),
        ];

        if ($model->relationLoaded('workOrders')) {
            $data['workOrders'] = $model->workOrders->map(fn ($w) => WorkOrdersDTO::fromModel($w))->all();
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
            'finished_product_name' => $this->finishedProductName,
            'version' => $this->version,
            'lead_time_days' => $this->leadTimeDays,
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
            'finished_product_name' => $this->finishedProductName,
            'version' => $this->version,
            'lead_time_days' => $this->leadTimeDays,
            'status' => $this->status,
        ];
    }
}
