<?php

namespace App\Http\Resources\Inventory;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StockMovementsResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'ref_number' => $this->ref_number,
            'date' => $this->date,
            'product_id' => $this->product_id,
            'movement_type' => $this->movement_type,
            'quantity' => $this->quantity,
            'from_warehouse' => $this->from_warehouse,
            'to_warehouse' => $this->to_warehouse,
            'reason_notes' => $this->reason_notes,
            'user_id' => $this->user_id,
            'product' => new ProductCatalogResource($this->whenLoaded('product')),
            'from_warehouse_details' => new \App\Http\Resources\Logistics\WarehousesResource($this->whenLoaded('fromWarehouse')),
            'to_warehouse_details' => new \App\Http\Resources\Logistics\WarehousesResource($this->whenLoaded('toWarehouse')),
            'user' => new \App\Http\Resources\UsersRoles\UsersResource($this->whenLoaded('user')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
