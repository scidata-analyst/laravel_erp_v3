<?php

namespace App\Http\Resources\Purchase;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SuppliersResource extends JsonResource
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
            'country' => $this->country,
            'payment_terms' => $this->payment_terms,
            'currency' => $this->currency,
            'address' => $this->address,
            'status' => $this->status,
            'rating' => $this->rating,
            'tax_id' => $this->tax_id,
            'website' => $this->website,
            'purchase_orders_count' => $this->whenLoaded('purchaseOrders', function () {
                return $this->purchaseOrders->count();
            }),
            'supplier_payments_count' => $this->whenLoaded('supplierPayments', function () {
                return $this->supplierPayments->count();
            }),
            'ap_ar_balance' => $this->whenLoaded('apArTransactions', function () {
                return $this->apArTransactions->sum('balance');
            }, $this->ap_ar_balance),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
