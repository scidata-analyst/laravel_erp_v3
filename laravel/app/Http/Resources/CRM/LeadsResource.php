<?php

namespace App\Http\Resources\CRM;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LeadsResource extends JsonResource
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
            'lead_name' => $this->lead_name,
            'company' => $this->company,
            'email' => $this->email,
            'phone' => $this->phone,
            'deal_value' => $this->deal_value,
            'stage' => $this->stage,
            'assigned_user_id' => $this->assigned_user_id,
            'notes' => $this->notes,
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
