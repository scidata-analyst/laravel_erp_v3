<?php

namespace App\Http\Resources\Sales;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DiscountsResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'code' => $this->discount_name,
            'name' => $this->name,
            'discount_name' => $this->discount_name,
            'type' => $this->type,
            'discount_type' => $this->discount_type,
            'value' => $this->value,
            'discount_value' => $this->discount_value,
            'start_date' => $this->start_date ? $this->start_date->toDateString() : null,
            'valid_from' => $this->valid_from,
            'end_date' => $this->end_date ? $this->end_date->toDateString() : null,
            'valid_to' => $this->valid_to,
            'max_uses' => $this->max_uses,
            'usage_limit' => $this->usage_limit,
            'description' => $this->description,
            'status' => $this->status,
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}
