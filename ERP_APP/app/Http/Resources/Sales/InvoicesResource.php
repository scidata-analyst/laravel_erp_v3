<?php

namespace App\Http\Resources\Sales;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoicesResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'invoice_number' => $this->invoice_number,
            'customer_id' => $this->customer_id,
            'sales_order_id' => $this->sales_order_id,
            'sales_order_ref' => $this->sales_order_ref,
            'invoice_date' => $this->invoice_date,
            'due_date' => $this->due_date,
            'amount' => $this->amount,
            'tax' => $this->tax,
            'paid_amount' => $this->paid_amount,
            'balance' => $this->balance,
            'status' => $this->status,
            'notes' => $this->notes,
            'generated_by' => $this->generated_by,
            'customer' => new CustomersResource($this->whenLoaded('customer')),
            'sales_order' => new SalesOrdersResource($this->whenLoaded('salesOrder')),
            'generated_by_user' => new \App\Http\Resources\UsersRoles\UsersResource($this->whenLoaded('generatedBy')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
