<?php

namespace App\DTOs\Purchase;

use App\DTOs\Logistics\WarehousesDTO;
use App\Models\Purchase\PurchaseOrders;

/**
 * Data Transfer Object for PurchaseOrders entity.
 *
 * Used for type-safe data transfer between layers
 * and encapsulates purchase order data.
 *
 * @property int|null $id
 * @property int|null $supplierId
 * @property string|null $poNumber
 * @property string|null $orderDate
 * @property string|null $expectedDeliveryDate
 * @property int|null $warehouseId
 * @property string|null $paymentTerms
 * @property float|null $totalAmount
 * @property int|null $status
 * @property string|null $createdAt
 * @property string|null $updatedAt
 * @property SuppliersDTO|null $supplier
 * @property WarehousesDTO|null $warehouse
 */
class PurchaseOrdersDTO
{
    /** @var int|null Unique identifier */
    public ?int $id;

    /** @var int|null Foreign key to suppliers table */
    public ?int $supplierId;

    /** @var string|null Purchase order number (e.g., 'PO-2024-0001') */
    public ?string $poNumber;

    /** @var string|null Date order was placed (Y-m-d) */
    public ?string $orderDate;

    /** @var string|null Expected delivery date (Y-m-d) */
    public ?string $expectedDeliveryDate;

    /** @var int|null Foreign key to warehouses table */
    public ?int $warehouseId;

    /** @var string|null Payment terms (e.g., 'Net 30', 'Net 60') */
    public ?string $paymentTerms;

    /** @var float|null Total order amount */
    public ?float $totalAmount;

    /** @var int|null Status: 0=Pending, 1=Approved, 2=Ordered, 3=Partial, 4=Received, 5=Cancelled */
    public ?int $status;

    /** @var string|null Creation timestamp (ISO 8601) */
    public ?string $createdAt;

    /** @var string|null Last update timestamp (ISO 8601) */
    public ?string $updatedAt;

    /** @var SuppliersDTO|null Related supplier */
    public ?SuppliersDTO $supplier;

    /** @var WarehousesDTO|null Related warehouse */
    public ?WarehousesDTO $warehouse;

    /**
     * Create a new PurchaseOrdersDTO instance.
     *
     * @param array $data Optional data array for initialization
     */
    public function __construct(array $data = [])
    {
        $this->id = isset($data['id']) ? (int) $data['id'] : null;
        $this->supplierId = isset($data['supplier_id']) ? (int) $data['supplier_id'] : null;
        $this->poNumber = $data['po_number'] ?? null;
        $this->orderDate = $data['order_date'] ?? null;
        $this->expectedDeliveryDate = $data['expected_delivery_date'] ?? null;
        $this->warehouseId = isset($data['warehouse_id']) ? (int) $data['warehouse_id'] : null;
        $this->paymentTerms = $data['payment_terms'] ?? null;
        $this->totalAmount = isset($data['total_amount']) ? (float) $data['total_amount'] : null;
        $this->status = isset($data['status']) ? (int) $data['status'] : null;
        $this->createdAt = $data['created_at'] ?? null;
        $this->updatedAt = $data['updated_at'] ?? null;
        $this->supplier = $data['supplier'] ?? null;
        $this->warehouse = $data['warehouse'] ?? null;
    }

    /**
     * Create DTO from Eloquent model instance.
     *
     * @param PurchaseOrders $model Eloquent model to convert
     * @return self New DTO instance with model data
     */
    public static function fromModel(PurchaseOrders $model): self
    {
        $data = [
            'id' => $model->id,
            'supplier_id' => $model->supplier_id,
            'po_number' => $model->po_number,
            'order_date' => $model->order_date,
            'expected_delivery_date' => $model->expected_delivery_date,
            'warehouse_id' => $model->warehouse_id,
            'payment_terms' => $model->payment_terms,
            'total_amount' => $model->total_amount,
            'status' => $model->status,
            'created_at' => $model->created_at?->toIso8601String(),
            'updated_at' => $model->updated_at?->toIso8601String(),
        ];

        if ($model->relationLoaded('supplier')) {
            $data['supplier'] = SuppliersDTO::fromModel($model->supplier);
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
            'supplier_id' => $this->supplierId,
            'po_number' => $this->poNumber,
            'order_date' => $this->orderDate,
            'expected_delivery_date' => $this->expectedDeliveryDate,
            'warehouse_id' => $this->warehouseId,
            'payment_terms' => $this->paymentTerms,
            'total_amount' => $this->totalAmount,
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
            'supplier_id' => $this->supplierId,
            'po_number' => $this->poNumber,
            'order_date' => $this->orderDate,
            'expected_delivery_date' => $this->expectedDeliveryDate,
            'warehouse_id' => $this->warehouseId,
            'payment_terms' => $this->paymentTerms,
            'total_amount' => $this->totalAmount,
            'status' => $this->status,
        ];
    }
}
