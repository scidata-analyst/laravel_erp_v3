<?php

namespace App\Http\Resources\Ecommerce;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PosTransactionsResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'terminal_id' => $this->terminal_id,
            'pos_id' => $this->terminal_id,
            'transaction_number' => $this->transaction_number,
            'transaction_type' => $this->transaction_type,
            'amount' => $this->amount,
            'tax_amount' => $this->tax_amount,
            'total_amount' => $this->total_amount,
            'payment_method' => $this->payment_method,
            'status' => $this->status,
            'items' => $this->items,
            'customer_id' => $this->customer_id,
            'order_reference' => $this->order_reference,
            'cash_tendered' => $this->cash_tendered,
            'change_given' => $this->change_given,
            'transaction_date' => $this->transaction_date,
            'terminal' => new PosResource($this->whenLoaded('terminal')),
            'customer' => new \App\Http\Resources\Sales\CustomersResource($this->whenLoaded('customer')),
            'sales_order' => new \App\Http\Resources\Sales\SalesOrdersResource($this->whenLoaded('salesOrder')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
