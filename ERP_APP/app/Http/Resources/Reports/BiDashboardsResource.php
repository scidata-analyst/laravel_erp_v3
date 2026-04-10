<?php

namespace App\Http\Resources\Reports;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BiDashboardsResource extends JsonResource
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
            'widget_name' => $this->widget_name,
            'chart_type' => $this->chart_type,
            'data_source_module' => $this->data_source_module,
            'refresh_rate' => $this->refresh_rate,
            'dashboard_name' => $this->dashboard_name,
            'created_by_user_id' => $this->created_by_user_id,
            'status' => $this->status,
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
