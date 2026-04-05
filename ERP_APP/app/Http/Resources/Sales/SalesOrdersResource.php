<?php

namespace App\Http\Resources\Sales;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SalesOrdersResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'so_number' => $this->so_number,
            'customer_id' => $this->customer_id,
            'customer_name' => $this->customer?->name,
            'order_date' => $this->order_date,
            'delivery_date' => $this->delivery_date,
            'payment_terms' => $this->payment_terms,
            'discount' => $this->discount,
            'total_amount' => $this->total_amount,
            'status' => $this->status,
            'order_items' => $this->order_items,
            'notes' => $this->notes,
            'customer' => new CustomersResource($this->whenLoaded('customer')),
            'invoices' => InvoicesResource::collection($this->whenLoaded('invoices')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
