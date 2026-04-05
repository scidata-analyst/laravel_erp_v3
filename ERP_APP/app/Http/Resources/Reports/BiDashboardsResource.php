<?php

namespace App\Http\Resources\Reports;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BiDashboardsResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'dashboard_name' => $this->dashboard_name,
            'dashboard' => $this->dashboard_name,
            'description' => $this->description,
            'widgets' => $this->widgets,
            'layout' => $this->layout,
            'layout_config' => $this->layout_config,
            'data_sources' => $this->data_sources,
            'refresh_interval' => $this->refresh_interval,
            'refresh_rate' => $this->refresh_interval,
            'access_level' => $this->access_level,
            'created_by' => $this->created_by,
            'is_public' => $this->is_public,
            'category' => $this->category,
            'status' => $this->status,
            'widget_items' => BiWidgetsResource::collection($this->whenLoaded('widgets')),
            'created_by_user' => new \App\Http\Resources\UsersRoles\UsersResource($this->whenLoaded('createdBy')),
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}
