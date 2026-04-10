<?php

namespace App\Http\Resources\Sales;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PromotionsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'promo_code' => $this->promo_code,
            'description' => $this->description,
            'discount_value' => $this->discount_value,
            'discount_type' => $this->discount_type,
            'minimum_order_amount' => $this->minimum_order_amount,
            'valid_from' => $this->valid_from,
            'valid_to' => $this->valid_to,
            'applicable_products' => $this->applicable_products,
            'status' => $this->status,
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
