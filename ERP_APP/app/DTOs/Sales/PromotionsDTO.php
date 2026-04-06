<?php

namespace App\DTOs\Sales;

class PromotionsDTO
{
    public readonly string $promotion_name;
    public readonly ?string $name;
    public readonly ?string $type;
    public readonly ?float $value;
    public readonly ?int $discount_id;
    public readonly string $start_date;
    public readonly string $end_date;
    public readonly array $applicable_products;
    public readonly float $minimum_purchase;
    public readonly float $min_order_amount;
    public readonly ?int $usage_limit;
    public readonly ?int $used_count;
    public readonly ?string $status;
    public readonly ?string $description;
    public readonly ?int $created_by;

    public function __construct(array $data)
    {
        $this->promotion_name = $data['promotion_name'] ?? $data['name'] ?? $data['code'] ?? '';
        $this->name = $data['name'] ?? $this->promotion_name;
        $this->type = $data['type'] ?? null;
        $this->value = isset($data['value']) ? (float) $data['value'] : null;
        $this->discount_id = isset($data['discount_id']) ? (int) $data['discount_id'] : null;
        $this->start_date = $data['start_date'] ?? '';
        $this->end_date = $data['end_date'] ?? '';
        $this->applicable_products = $data['applicable_products'] ?? ($data['applicable_to'] ?? []);
        
        $this->minimum_purchase = isset($data['minimum_purchase'])
            ? (float) $data['minimum_purchase']
            : (float) ($data['minimum_order_amount'] ?? $data['min_order_amount'] ?? $data['min_purchase_amount'] ?? 0);
        
        $this->min_order_amount = isset($data['min_order_amount'])
            ? (float) $data['min_order_amount']
            : (float) ($data['minimum_order_amount'] ?? $this->minimum_purchase);
        
        $this->usage_limit = isset($data['usage_limit']) ? (int) $data['usage_limit'] : null;
        $this->used_count = isset($data['used_count']) ? (int) $data['used_count'] : null;
        $this->status = $data['status'] ?? 'active';
        $this->description = $data['description'] ?? null;
        $this->created_by = isset($data['created_by']) ? (int) $data['created_by'] : null;
    }
}