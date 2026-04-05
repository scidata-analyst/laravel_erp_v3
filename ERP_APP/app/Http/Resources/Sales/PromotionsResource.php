<?php

namespace App\Http\Resources\Sales;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PromotionsResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'promotion_name' => $this->promotion_name,
            'name' => $this->name,
            'description' => $this->description,
            'discount_id' => $this->discount_id,
            'type' => $this->type,
            'discount_type' => $this->discount_type,
            'value' => $this->value,
            'discount_value' => $this->discount_value,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'minimum_purchase' => $this->minimum_purchase,
            'min_order_amount' => $this->min_order_amount,
            'min_purchase_amount' => $this->min_purchase_amount,
            'applicable_products' => $this->applicable_products,
            'status' => $this->status,
            'applicable_to' => $this->applicable_products,
            'usage_limit' => $this->usage_limit,
            'used_count' => $this->used_count,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
