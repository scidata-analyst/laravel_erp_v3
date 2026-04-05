<?php

namespace App\Http\Resources\Accounting;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionsResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'account' => new GlResource($this->whenLoaded('account')),
            'transaction_type' => $this->transaction_type,
            'amount' => $this->amount,
            'description' => $this->description,
            'transaction_date' => $this->transaction_date->toDateString(),
            'created_at' => $this->created_at->toDateTimeString(),
        ];
    }
}
