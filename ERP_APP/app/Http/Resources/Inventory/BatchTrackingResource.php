<?php

namespace App\Http\Resources\Inventory;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BatchTrackingResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'batch_lot_number' => $this->batch_lot_number,
            'serial_number' => $this->serial_number,
            'product_id' => $this->product_id,
            'quantity' => $this->quantity,
            'manufacturing_date' => $this->manufacturing_date,
            'expiry_date' => $this->expiry_date,
            'status' => $this->status,
            'warehouse_location' => $this->warehouse_location,
            'cost_per_unit' => $this->cost_per_unit,
            'product' => new ProductCatalogResource($this->whenLoaded('product')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
