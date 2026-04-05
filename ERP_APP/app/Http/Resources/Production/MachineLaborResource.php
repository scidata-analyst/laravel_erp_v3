<?php

namespace App\Http\Resources\Production;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MachineLaborResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'work_order_id' => $this->work_order_id,
            'resource_name' => $this->resource_name,
            'type' => $this->type,
            'scheduled_hours' => $this->scheduled_hours,
            'actual_hours' => $this->actual_hours,
            'cost_per_hour' => $this->cost_per_hour,
            'notes' => $this->notes,
            'work_order' => new WorkOrdersResource($this->whenLoaded('workOrder')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
