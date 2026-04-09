<?php

namespace App\DTOs\Purchase;

use App\DTOs\Logistics\WarehousesDTO;
use App\Models\Purchase\Grn;

class GrnDTO
{
    public ?int $id;

    public ?int $purchaseOrderId;

    public ?string $supplierName;

    public ?string $grnNumber;

    public ?string $receiptDate;

    public ?int $warehouseId;

    public ?string $notes;

    public ?int $status;

    public ?string $createdAt;

    public ?string $updatedAt;

    public ?PurchaseOrdersDTO $purchaseOrder;

    public ?WarehousesDTO $warehouse;

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

    public static function fromArray(array $data): self
    {
        return new self($data);
    }

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
