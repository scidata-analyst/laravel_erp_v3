<?php

namespace App\DTOs\Sales;

use App\Models\Sales\Promotions;

class PromotionsDTO
{
    public ?int $id;

    public ?string $promoCode;

    public ?string $description;

    public ?float $discountValue;

    public ?string $discountType;

    public ?float $minimumOrderAmount;

    public ?string $validFrom;

    public ?string $validTo;

    public ?string $applicableProducts;

    public ?int $status;

    public ?string $createdAt;

    public ?string $updatedAt;

    public function __construct(array $data = [])
    {
        $this->id = isset($data['id']) ? (int) $data['id'] : null;
        $this->promoCode = $data['promo_code'] ?? null;
        $this->description = $data['description'] ?? null;
        $this->discountValue = isset($data['discount_value']) ? (float) $data['discount_value'] : null;
        $this->discountType = $data['discount_type'] ?? null;
        $this->minimumOrderAmount = isset($data['minimum_order_amount']) ? (float) $data['minimum_order_amount'] : null;
        $this->validFrom = $data['valid_from'] ?? null;
        $this->validTo = $data['valid_to'] ?? null;
        $this->applicableProducts = $data['applicable_products'] ?? null;
        $this->status = isset($data['status']) ? (int) $data['status'] : null;
        $this->createdAt = $data['created_at'] ?? null;
        $this->updatedAt = $data['updated_at'] ?? null;
    }

    public static function fromModel(Promotions $model): self
    {
        return new self([
            'id' => $model->id,
            'promo_code' => $model->promo_code,
            'description' => $model->description,
            'discount_value' => $model->discount_value,
            'discount_type' => $model->discount_type,
            'minimum_order_amount' => $model->minimum_order_amount,
            'valid_from' => $model->valid_from,
            'valid_to' => $model->valid_to,
            'applicable_products' => $model->applicable_products,
            'status' => $model->status,
            'created_at' => $model->created_at?->toIso8601String(),
            'updated_at' => $model->updated_at?->toIso8601String(),
        ]);
    }

    public static function fromArray(array $data): self
    {
        return new self($data);
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'promo_code' => $this->promoCode,
            'description' => $this->description,
            'discount_value' => $this->discountValue,
            'discount_type' => $this->discountType,
            'minimum_order_amount' => $this->minimumOrderAmount,
            'valid_from' => $this->validFrom,
            'valid_to' => $this->validTo,
            'applicable_products' => $this->applicableProducts,
            'status' => $this->status,
            'created_at' => $this->createdAt,
            'updated_at' => $this->updatedAt,
        ];
    }

    public function toModel(): array
    {
        return [
            'promo_code' => $this->promoCode,
            'description' => $this->description,
            'discount_value' => $this->discountValue,
            'discount_type' => $this->discountType,
            'minimum_order_amount' => $this->minimumOrderAmount,
            'valid_from' => $this->validFrom,
            'valid_to' => $this->validTo,
            'applicable_products' => $this->applicableProducts,
            'status' => $this->status,
        ];
    }
}
