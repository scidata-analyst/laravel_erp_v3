<?php

namespace App\DTOs\Sales;

use App\Models\Sales\Promotions;

/**
 * Data Transfer Object for Promotions entity.
 *
 * Used for type-safe data transfer between layers
 * and encapsulates promotional campaign data.
 *
 * @property int|null $id
 * @property string|null $promoCode
 * @property string|null $description
 * @property float|null $discountValue
 * @property string|null $discountType
 * @property float|null $minimumOrderAmount
 * @property string|null $validFrom
 * @property string|null $validTo
 * @property string|null $applicableProducts
 * @property int|null $status
 * @property string|null $createdAt
 * @property string|null $updatedAt
 */
class PromotionsDTO
{
    /** @var int|null Unique identifier */
    public ?int $id;

    /** @var string|null Promotion code (e.g., 'SUMMER20', 'FLAT500') */
    public ?string $promoCode;

    /** @var string|null Description of the promotion */
    public ?string $description;

    /** @var float|null Discount value (percentage or fixed amount based on discountType) */
    public ?float $discountValue;

    /** @var string|null Type of discount: 'percentage' or 'fixed' */
    public ?string $discountType;

    /** @var float|null Minimum order amount required to apply this promotion */
    public ?float $minimumOrderAmount;

    /** @var string|null Promotion start date (Y-m-d H:i:s) */
    public ?string $validFrom;

    /** @var string|null Promotion end date (Y-m-d H:i:s) */
    public ?string $validTo;

    /** @var string|null Comma-separated product IDs or product category this applies to */
    public ?string $applicableProducts;

    /** @var int|null Status: 0=Inactive, 1=Active, 2=Scheduled, 3=Expired */
    public ?int $status;

    /** @var string|null Creation timestamp (ISO 8601) */
    public ?string $createdAt;

    /** @var string|null Last update timestamp (ISO 8601) */
    public ?string $updatedAt;

    /**
     * Create a new PromotionsDTO instance.
     *
     * @param array $data Optional data array for initialization
     */
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

    /**
     * Create DTO from Eloquent model instance.
     *
     * @param Promotions $model Eloquent model to convert
     * @return self New DTO instance with model data
     */
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
