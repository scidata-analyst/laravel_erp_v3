<?php

namespace App\Http\Resources\Reports;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ForecastingResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'forecast_name' => $this->forecast_name,
            'name' => $this->forecast_name,
            'forecast_type' => $this->forecast_type,
            'model_type' => $this->forecast_type,
            'start_date' => $this->start_date?->toDateString(),
            'period_from' => $this->start_date?->toDateString(),
            'end_date' => $this->end_date?->toDateString(),
            'period_to' => $this->end_date?->toDateString(),
            'period' => trim(($this->start_date?->toDateString() ?? '') . ' - ' . ($this->end_date?->toDateString() ?? ''), ' -'),
            'data_model' => $this->base_data_source,
            'data_source' => $this->base_data_source,
            'status' => $this->status,
            'accuracy' => $this->accuracy,
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}
