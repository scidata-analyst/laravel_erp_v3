<?php

namespace App\DTOs\Sales;

class PromotionsDTO
{
    public function __construct(
        public readonly string $promotion_name,
        public readonly ?string $name = null,
        public readonly ?string $type = null,
        public readonly ?float $value = null,
        public readonly ?int $discount_id = null,
        public readonly string $start_date = '',
        public readonly string $end_date = '',
        public readonly array $applicable_products = [],
        public readonly float $minimum_purchase = 0,
        public readonly float $min_order_amount = 0,
        public readonly ?int $usage_limit = null,
        public readonly ?int $used_count = null,
        public readonly ?string $status = 'active',
        public readonly ?string $description = null,
        public readonly ?int $created_by = null,
    ) {}

    public static function fromRequest(array $data): self
    {
        $promotionName = $data['promotion_name'] ?? $data['name'] ?? $data['code'] ?? '';
        $minimumPurchase = isset($data['minimum_purchase'])
            ? (float) $data['minimum_purchase']
            : (float) ($data['minimum_order_amount'] ?? $data['min_order_amount'] ?? $data['min_purchase_amount'] ?? 0);

        return new self(
            promotion_name: $promotionName,
            name: $data['name'] ?? $promotionName,
            type: $data['type'] ?? null,
            value: isset($data['value']) ? (float) $data['value'] : null,
            discount_id: isset($data['discount_id']) ? (int) $data['discount_id'] : null,
            start_date: $data['start_date'] ?? '',
            end_date: $data['end_date'] ?? '',
            applicable_products: $data['applicable_products'] ?? ($data['applicable_to'] ?? []),
            minimum_purchase: $minimumPurchase,
            min_order_amount: isset($data['min_order_amount'])
                ? (float) $data['min_order_amount']
                : (float) ($data['minimum_order_amount'] ?? $minimumPurchase),
            usage_limit: isset($data['usage_limit']) ? (int) $data['usage_limit'] : null,
            used_count: isset($data['used_count']) ? (int) $data['used_count'] : null,
            status: $data['status'] ?? 'active',
            description: $data['description'] ?? null,
            created_by: isset($data['created_by']) ? (int) $data['created_by'] : null,
        );
    }

    public function toArray(): array
    {
        return [
            'promotion_name' => $this->promotion_name,
            'name' => $this->name,
            'discount_id' => $this->discount_id,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'applicable_products' => $this->applicable_products,
            'minimum_purchase' => $this->minimum_purchase,
            'min_order_amount' => $this->min_order_amount,
            'usage_limit' => $this->usage_limit,
            'used_count' => $this->used_count,
            'status' => $this->status,
            'description' => $this->description,
            'created_by' => $this->created_by,
        ];
    }
}
