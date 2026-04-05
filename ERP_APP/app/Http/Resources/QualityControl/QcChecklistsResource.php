<?php

namespace App\Http\Resources\QualityControl;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QcChecklistsResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'checklist_number' => $this->checklist_number,
            'name' => $this->checklist_number,
            'inspector_id' => $this->inspector_id,
            'work_order_id' => $this->work_order_id,
            'inspection_type' => $this->inspection_type,
            'inspection_date' => $this->inspection_date,
            'sample_size' => $this->sample_size,
            'items_checked' => $this->items_checked,
            'items_passed' => $this->items_passed,
            'pass_rate' => $this->pass_rate,
            'status' => $this->status,
            'checklist_items' => $this->checklist_items,
            'criteria' => $this->checklist_items,
            'notes' => $this->notes,
            'inspector' => new \App\Http\Resources\HR\EmployeesResource($this->whenLoaded('inspector')),
            'work_order' => new \App\Http\Resources\Production\WorkOrdersResource($this->whenLoaded('workOrder')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
