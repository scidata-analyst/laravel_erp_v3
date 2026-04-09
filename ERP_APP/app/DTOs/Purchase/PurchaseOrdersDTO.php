<?php

namespace App\DTOs\Purchase;

use App\DTOs\Logistics\WarehousesDTO;
use App\Models\Purchase\PurchaseOrders;

class PurchaseOrdersDTO
{
    public ?int $id;

    public ?int $supplierId;

    public ?string $poNumber;

    public ?string $orderDate;

    public ?string $expectedDeliveryDate;

    public ?int $warehouseId;

    public ?string $paymentTerms;

    public ?float $totalAmount;

    public ?int $status;

    public ?string $createdAt;

    public ?string $updatedAt;

    public ?SuppliersDTO $supplier;

    public ?WarehousesDTO $warehouse;

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

    public static function fromArray(array $data): self
    {
        return new self($data);
    }

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
