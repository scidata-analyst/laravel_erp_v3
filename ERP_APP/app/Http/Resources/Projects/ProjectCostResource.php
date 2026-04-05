<?php

namespace App\Http\Resources\Projects;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectCostResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'project_id' => $this->project_id,
            'project' => $this->project?->task_title ?? $this->project_id,
            'cost_category' => $this->cost_category,
            'category' => $this->cost_category,
            'description' => $this->description,
            'budgeted_amount' => $this->budgeted_amount,
            'actual_amount' => $this->actual_amount,
            'amount' => $this->amount,
            'variance' => $this->variance,
            'variance_percentage' => $this->budgeted_amount > 0 ? ($this->variance / $this->budgeted_amount) * 100 : 0,
            'currency' => $this->currency,
            'cost_date' => $this->cost_date,
            'date' => $this->cost_date,
            'approved_by' => $this->whenLoaded('approvedBy', function () {
                return [
                    'id' => $this->approvedBy->id,
                    'name' => $this->approvedBy->name
                ];
            }, $this->approvedBy?->name ?? $this->approved_by),
            'status' => ucfirst((string) $this->status),
            'is_over_budget' => $this->variance > 0,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
