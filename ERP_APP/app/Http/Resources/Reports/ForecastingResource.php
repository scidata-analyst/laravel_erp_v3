<?php

namespace App\Http\Resources\Reports;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ForecastingResource extends JsonResource
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
            'forecast_name' => $this->forecast_name,
            'forecast_type' => $this->forecast_type,
            'period_from' => $this->period_from,
            'period_to' => $this->period_to,
            'model' => $this->model,
            'accuracy_percentage' => $this->accuracy_percentage,
            'status' => $this->status,
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
