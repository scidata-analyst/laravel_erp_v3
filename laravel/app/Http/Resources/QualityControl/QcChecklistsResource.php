<?php

namespace App\Http\Resources\QualityControl;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QcChecklistsResource extends JsonResource
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
            'product_batch_work_order' => $this->product_batch_work_order,
            'inspector_id' => $this->inspector_id,
            'inspection_type' => $this->inspection_type,
            'inspection_date' => $this->inspection_date,
            'sample_size' => $this->sample_size,
            'checklist_items_notes' => $this->checklist_items_notes,
            'status' => $this->status,
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
