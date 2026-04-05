<?php

namespace App\Http\Resources\Projects;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ResourcesResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->resource_name,
            'project_id' => $this->project_id,
            'type' => $this->resource_type,
            'resource_type' => $this->resource_type,
            'allocation' => $this->allocation_percentage,
            'allocation_percentage' => $this->allocation_percentage,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'cost_per_hour' => $this->cost_per_hour,
            'availability' => $this->availability ?? $this->status,
            'status' => $this->status,
            'skills' => $this->skills ?? [],
            'notes' => $this->notes,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
