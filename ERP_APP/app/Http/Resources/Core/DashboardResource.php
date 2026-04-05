<?php

namespace App\Http\Resources\Core;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DashboardResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'metric_name' => $this->metric_name,
            'metric_value' => $this->metric_value,
            'category' => $this->category,
            'period' => $this->period,
            'extra_data' => $this->extra_data,
            'created_at' => $this->created_at->toDateTimeString(),
        ];
    }
}
