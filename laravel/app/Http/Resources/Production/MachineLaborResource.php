<?php

namespace App\Http\Resources\Production;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MachineLaborResource extends JsonResource
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
            'work_order_id' => $this->work_order_id,
            'resource_name' => $this->resource_name,
            'resource_type' => $this->resource_type,
            'hours_used' => $this->hours_used,
            'cost_per_hour' => $this->cost_per_hour,
            'total_cost' => $this->total_cost,
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
