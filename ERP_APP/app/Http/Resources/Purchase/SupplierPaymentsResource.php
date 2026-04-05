<?php

namespace App\Http\Resources\Purchase;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SupplierPaymentsResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'payment_number' => $this->payment_number,
            'payment_ref' => $this->payment_number,
            'supplier_id' => $this->supplier_id,
            'purchase_order_id' => $this->purchase_order_id,
            'amount' => $this->amount,
            'payment_date' => $this->payment_date,
            'payment_method' => $this->payment_method,
            'reference_number' => $this->reference_number,
            'reference' => $this->reference_number,
            'status' => $this->status,
            'approved_by' => $this->approved_by,
            'notes' => $this->notes,
            'supplier_name' => $this->supplier?->company_name ?? $this->supplier?->name,
            'purchase_order_number' => $this->purchaseOrder?->po_number,
            'supplier' => new SuppliersResource($this->whenLoaded('supplier')),
            'purchase_order' => new PurchaseOrdersResource($this->whenLoaded('purchaseOrder')),
            'approver' => new \App\Http\Resources\UsersRoles\UsersResource($this->whenLoaded('approvedBy')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
