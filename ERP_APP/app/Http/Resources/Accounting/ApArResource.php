<?php

namespace App\Http\Resources\Accounting;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ApArResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'ref_number' => $this->ref_number,
            'party_name' => $this->party_name,
            'type' => $this->type,
            'due_date' => $this->due_date,
            'amount' => $this->amount,
            'paid' => $this->paid,
            'balance' => $this->amount - ($this->paid ?? 0),
            'status' => $this->status,
            'reference' => $this->reference,
            'description' => $this->description,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
