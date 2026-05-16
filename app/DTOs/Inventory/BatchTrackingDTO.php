<?php

namespace App\DTOs\Inventory;

use App\Models\Inventory\BatchTracking;

/**
 * Data Transfer Object for BatchTracking entity.
 *
 * Used for type-safe data transfer between layers
 * and encapsulates batch/lot tracking data.
 *
 * @property int|null $id
 * @property int|null $productId
 * @property string|null $batchLotNumber
 * @property string|null $serialNumber
 * @property int|null $quantity
 * @property string|null $manufactureDate
 * @property string|null $expiryDate
 * @property string|null $createdAt
 * @property string|null $updatedAt
 * @property ProductCatalogDTO|null $product
 */
class BatchTrackingDTO
{
    /** @var int|null Unique identifier */
    public ?int $id;

    /** @var int|null Foreign key to products table */
    public ?int $productId;

    /** @var string|null Batch/Lot number for tracking */
    public ?string $batchLotNumber;

    /** @var string|null Serial number (if applicable for unique item tracking) */
    public ?string $serialNumber;

    /** @var int|null Quantity in this batch */
    public ?int $quantity;

    /** @var string|null Manufacturing date (Y-m-d) */
    public ?string $manufactureDate;

    /** @var string|null Expiration date (Y-m-d) */
    public ?string $expiryDate;

    /** @var string|null Creation timestamp (ISO 8601) */
    public ?string $createdAt;

    /** @var string|null Last update timestamp (ISO 8601) */
    public ?string $updatedAt;

    /** @var ProductCatalogDTO|null Related product */
    public ?ProductCatalogDTO $product;

    /**
     * Create a new BatchTrackingDTO instance.
     *
     * @param array $data Optional data array for initialization
     */
    public function __construct(array $data = [])
    {
        $this->id = isset($data['id']) ? (int) $data['id'] : null;
        $this->productId = isset($data['product_id']) ? (int) $data['product_id'] : null;
        $this->batchLotNumber = $data['batch_lot_number'] ?? null;
        $this->serialNumber = $data['serial_number'] ?? null;
        $this->quantity = isset($data['quantity']) ? (int) $data['quantity'] : null;
        $this->manufactureDate = $data['manufacture_date'] ?? null;
        $this->expiryDate = $data['expiry_date'] ?? null;
        $this->createdAt = $data['created_at'] ?? null;
        $this->updatedAt = $data['updated_at'] ?? null;
        $this->product = $data['product'] ?? null;
    }

    /**
     * Create DTO from Eloquent model instance.
     *
     * @param BatchTracking $model Eloquent model to convert
     * @return self New DTO instance with model data
     */
    public static function fromModel(BatchTracking $model): self
    {
        $data = [
            'id' => $model->id,
            'product_id' => $model->product_id,
            'batch_lot_number' => $model->batch_lot_number,
            'serial_number' => $model->serial_number,
            'quantity' => $model->quantity,
            'manufacture_date' => $model->manufacture_date,
            'expiry_date' => $model->expiry_date,
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
            'serial_number' => $this->serialNumber,
            'quantity' => $this->quantity,
            'manufacture_date' => $this->manufactureDate,
            'expiry_date' => $this->expiryDate,
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
            'serial_number' => $this->serialNumber,
            'quantity' => $this->quantity,
            'manufacture_date' => $this->manufactureDate,
            'expiry_date' => $this->expiryDate,
        ];
    }
}
