<?php

namespace App\DTOs\Purchase;

use App\DTOs\Logistics\WarehousesDTO;
use App\Models\Purchase\Grn;

/**
 * Data Transfer Object for Grn (Goods Receipt Note) entity.
 *
 * Used for type-safe data transfer between layers
 * and encapsulates goods receipt note data.
 *
 * @property int|null $id
 * @property int|null $purchaseOrderId
 * @property string|null $supplierName
 * @property string|null $grnNumber
 * @property string|null $receiptDate
 * @property int|null $warehouseId
 * @property string|null $notes
 * @property int|null $status
 * @property string|null $createdAt
 * @property string|null $updatedAt
 * @property PurchaseOrdersDTO|null $purchaseOrder
 * @property WarehousesDTO|null $warehouse
 */
class GrnDTO
{
    /** @var int|null Unique identifier */
    public ?int $id;

    /** @var int|null Foreign key to purchase_orders table */
    public ?int $purchaseOrderId;

    /** @var string|null Supplier name (denormalized) */
    public ?string $supplierName;

    /** @var string|null Goods Receipt Note number (e.g., 'GRN-2024-0001') */
    public ?string $grnNumber;

    /** @var string|null Date goods were received (Y-m-d) */
    public ?string $receiptDate;

    /** @var int|null Foreign key to warehouses table */
    public ?int $warehouseId;

    /** @var string|null Additional notes */
    public ?string $notes;

    /** @var int|null Status: 0=Pending, 1=InProgress, 2=Completed, 3=Cancelled */
    public ?int $status;

    /** @var string|null Creation timestamp (ISO 8601) */
    public ?string $createdAt;

    /** @var string|null Last update timestamp (ISO 8601) */
    public ?string $updatedAt;

    /** @var PurchaseOrdersDTO|null Related purchase order */
    public ?PurchaseOrdersDTO $purchaseOrder;

    /** @var WarehousesDTO|null Related warehouse */
    public ?WarehousesDTO $warehouse;

    /**
     * Create a new GrnDTO instance.
     *
     * @param array $data Optional data array for initialization
     */
    public function __construct(array $data = [])
    {
        $this->id = isset($data['id']) ? (int) $data['id'] : null;
        $this->purchaseOrderId = isset($data['purchase_order_id']) ? (int) $data['purchase_order_id'] : null;
        $this->supplierName = $data['supplier_name'] ?? null;
        $this->grnNumber = $data['grn_number'] ?? null;
        $this->receiptDate = $data['receipt_date'] ?? null;
        $this->warehouseId = isset($data['warehouse_id']) ? (int) $data['warehouse_id'] : null;
        $this->notes = $data['notes'] ?? null;
        $this->status = isset($data['status']) ? (int) $data['status'] : null;
        $this->createdAt = $data['created_at'] ?? null;
        $this->updatedAt = $data['updated_at'] ?? null;
        $this->purchaseOrder = $data['purchaseOrder'] ?? null;
        $this->warehouse = $data['warehouse'] ?? null;
    }

    /**
     * Create DTO from Eloquent model instance.
     *
     * @param Grn $model Eloquent model to convert
     * @return self New DTO instance with model data
     */
    public static function fromModel(Grn $model): self
    {
        $data = [
            'id' => $model->id,
            'purchase_order_id' => $model->purchase_order_id,
            'supplier_name' => $model->supplier_name,
            'grn_number' => $model->grn_number,
            'receipt_date' => $model->receipt_date,
            'warehouse_id' => $model->warehouse_id,
            'notes' => $model->notes,
            'status' => $model->status,
            'created_at' => $model->created_at?->toIso8601String(),
            'updated_at' => $model->updated_at?->toIso8601String(),
        ];

        if ($model->relationLoaded('purchaseOrder')) {
            $data['purchaseOrder'] = PurchaseOrdersDTO::fromModel($model->purchaseOrder);
        }

        if ($model->relationLoaded('warehouse')) {
            $data['warehouse'] = WarehousesDTO::fromModel($model->warehouse);
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
            'purchase_order_id' => $this->purchaseOrderId,
            'supplier_name' => $this->supplierName,
            'grn_number' => $this->grnNumber,
            'receipt_date' => $this->receiptDate,
            'warehouse_id' => $this->warehouseId,
            'notes' => $this->notes,
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
            'purchase_order_id' => $this->purchaseOrderId,
            'supplier_name' => $this->supplierName,
            'grn_number' => $this->grnNumber,
            'receipt_date' => $this->receiptDate,
            'warehouse_id' => $this->warehouseId,
            'notes' => $this->notes,
            'status' => $this->status,
        ];
    }
}
