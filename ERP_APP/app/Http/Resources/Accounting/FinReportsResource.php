<?php

namespace App\Http\Resources\Accounting;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FinReportsResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'report_name' => $this->report_name,
            'report_type' => $this->report_type,
            'period_start' => $this->period_start,
            'period_end' => $this->period_end,
            'generated_by' => $this->generated_by,
            'status' => $this->status,
            'data_snapshot' => $this->data_snapshot,
            'generator' => new \App\Http\Resources\UsersRoles\UsersResource($this->whenLoaded('generatedBy')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
