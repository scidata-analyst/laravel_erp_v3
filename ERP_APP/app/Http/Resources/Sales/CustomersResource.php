<?php

namespace App\Http\Resources\Sales;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomersResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'company_name' => $this->company_name,
            'name' => $this->name,
            'contact_person' => $this->contact_person,
            'email' => $this->email,
            'phone' => $this->phone,
            'credit_limit' => $this->credit_limit,
            'sales_rep' => $this->sales_rep,
            'billing_address' => $this->billing_address,
            'shipping_address' => $this->shipping_address,
            'status' => $this->status,
            'tax_id' => $this->tax_id,
            'payment_terms' => $this->payment_terms,
            'sales_orders_count' => $this->whenLoaded('salesOrders', function () {
                return $this->salesOrders->count();
            }),
            'invoices_count' => $this->whenLoaded('invoices', function () {
                return $this->invoices->count();
            }),
            'outstanding' => $this->outstanding,
            'outstanding_balance' => $this->whenLoaded('apArTransactions', function () {
                return $this->apArTransactions->sum('balance');
            }, $this->outstanding_balance),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
