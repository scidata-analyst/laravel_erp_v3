<?php

namespace App\Http\Resources\Production;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkOrdersResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'order_number' => $this->order_number,
            'product' => $this->product ? $this->product->product_name : null,
            'quantity' => $this->quantity,
            'start_date' => $this->start_date->toDateString(),
            'end_date' => $this->end_date ? $this->end_date->toDateString() : null,
            'status' => $this->status,
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}
