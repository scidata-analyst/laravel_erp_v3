<?php

namespace App\Http\Resources\Accounting;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaxResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'tax_name' => $this->tax_name,
            'name' => $this->tax_name,
            'tax_rate' => $this->tax_rate,
            'rate' => $this->tax_rate,
            'tax_type' => $this->tax_type,
            'type' => $this->tax_type,
            'applicable_to' => $this->applicable_to,
            'description' => $this->description,
            'effective_date' => $this->effective_date,
            'status' => $this->status,
            'tax_code' => $this->tax_code,
            'jurisdiction' => $this->jurisdiction,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
