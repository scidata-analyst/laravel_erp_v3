<?php

namespace App\DTOs\QualityControl;

use App\DTOs\Inventory\ProductCatalogDTO;
use App\Models\QualityControl\Defects;

class DefectsDTO
{
    public ?int $id;

    public ?int $productId;

    public ?string $batchLotNumber;

    public ?string $defectType;

    public ?string $severity;

    public ?int $quantityAffected;

    public ?string $descriptionRootCause;

    public ?int $status;

    public ?string $createdAt;

    public ?string $updatedAt;

    public ?ProductCatalogDTO $product;

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
            'defect_type' => $this->defectType,
            'severity' => $this->severity,
            'quantity_affected' => $this->quantityAffected,
            'description_root_cause' => $this->descriptionRootCause,
            'status' => $this->status,
            'created_at' => $this->createdAt,
            'updated_at' => $this->updatedAt,
        ];
    }

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
