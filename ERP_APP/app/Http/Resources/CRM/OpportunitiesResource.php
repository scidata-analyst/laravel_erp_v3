<?php

namespace App\Http\Resources\CRM;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OpportunitiesResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'opportunity_name' => $this->opportunity_name,
            'lead' => $this->lead ? ($this->lead->first_name . ' ' . $this->lead->last_name) : null,
            'amount' => $this->amount,
            'stage' => $this->stage,
            'probability' => $this->probability,
            'expected_close_date' => $this->expected_close_date ? $this->expected_close_date->toDateString() : null,
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}
