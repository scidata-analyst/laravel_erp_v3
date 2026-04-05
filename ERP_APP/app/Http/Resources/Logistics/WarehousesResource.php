<?php

namespace App\Http\Resources\Logistics;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WarehousesResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'warehouse_name' => $this->warehouse_name,
            'code' => $this->code,
            'type' => $this->type,
            'location' => $this->location,
            'location_address' => $this->location_address,
            'manager' => $this->whenLoaded('manager', fn () => $this->manager?->full_name, $this->getAttribute('manager')),
            'manager_id' => $this->manager_id,
            'capacity' => $this->capacity,
            'capacity_units' => $this->capacity_units,
            'status' => $this->status,
            'contact_phone' => $this->contact_phone,
            'email' => $this->email,
            'manager_details' => new \App\Http\Resources\HR\EmployeesResource($this->whenLoaded('manager')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
