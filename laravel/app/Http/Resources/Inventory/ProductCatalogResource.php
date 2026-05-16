<?php

namespace App\Http\Resources\Inventory;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductCatalogResource extends JsonResource
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
            'product_name' => $this->product_name,
            'sku' => $this->sku,
            'category' => $this->category,
            'unit_price' => $this->unit_price,
            'cost_price' => $this->cost_price,
            'warehouse_id' => $this->warehouse_id,
            'reorder_level' => $this->reorder_level,
            'valuation_method' => $this->valuation_method,
            'description' => $this->description,
            'status' => $this->status,
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
