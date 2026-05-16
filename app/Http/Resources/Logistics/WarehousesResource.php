<?php

namespace App\Http\Resources\Logistics;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WarehousesResource extends JsonResource
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
            'warehouse_name' => $this->warehouse_name,
            'warehouse_code' => $this->warehouse_code,
            'warehouse_type' => $this->warehouse_type,
            'location_address' => $this->location_address,
            'manager_id' => $this->manager_id,
            'capacity_units' => $this->capacity_units,
            'status' => $this->status,
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
