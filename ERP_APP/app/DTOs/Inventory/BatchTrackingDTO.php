<?php

namespace App\DTOs\Inventory;

use App\Models\Inventory\BatchTracking;

class BatchTrackingDTO
{
    public ?int $id;

    public ?int $productId;

    public ?string $batchLotNumber;

    public ?string $serialNumber;

    public ?int $quantity;

    public ?string $manufactureDate;

    public ?string $expiryDate;

    public ?string $createdAt;

    public ?string $updatedAt;

    public ?ProductCatalogDTO $product;

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

    public static function fromArray(array $data): self
    {
        return new self($data);
    }

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
