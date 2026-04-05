<?php

namespace App\Http\Resources\QualityControl;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DefectsResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'product_id' => $this->product_id,
            'product' => $this->product ? $this->product->product_name : null,
            'defect_type' => $this->defect_type,
            'description' => $this->description,
            'severity' => $this->severity ? ucfirst($this->severity) : null,
            'status' => $this->status === 'in_progress' ? 'In Review' : ($this->status ? ucfirst($this->status) : null),
            'resolution' => $this->resolution,
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}
