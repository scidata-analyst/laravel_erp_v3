<?php

namespace App\Http\Resources\Inventory;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StockValuationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'product_id' => $this->product_id,
            'valuation_date' => $this->valuation_date,
            'valuation_method' => $this->valuation_method,
            'quantity_on_hand' => $this->quantity_on_hand,
            'total_quantity' => $this->quantity_on_hand,
            'unit_cost' => $this->unit_cost,
            'total_value' => $this->total_value,
            'product' => new ProductCatalogResource($this->whenLoaded('product')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
