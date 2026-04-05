<?php

namespace App\Http\Resources\Reports;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BiWidgetsResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'widget_name' => $this->widget_name,
            'widget_type' => $this->widget_type,
            'dashboard_id' => $this->dashboard_id,
            'data_source' => $this->data_source,
            'query_config' => $this->query_config,
            'visualization_type' => $this->visualization_type,
            'position_x' => $this->position_x,
            'position_y' => $this->position_y,
            'width' => $this->width,
            'height' => $this->height,
            'refresh_interval' => $this->refresh_interval,
            'settings' => $this->settings,
            'dashboard' => new BiDashboardsResource($this->whenLoaded('dashboard')),
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}
