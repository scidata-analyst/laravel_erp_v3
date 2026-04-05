<?php

namespace App\Http\Resources\Purchase;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseOrdersResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'po_number' => $this->po_number,
            'supplier_id' => $this->supplier_id,
            'order_date' => $this->order_date,
            'expected_delivery' => $this->expected_delivery,
            'warehouse' => $this->warehouse,
            'payment_terms' => $this->payment_terms,
            'total_amount' => $this->total_amount,
            'status' => $this->status,
            'approved_by' => $this->approved_by,
            'order_items' => $this->order_items,
            'notes' => $this->notes,
            'supplier' => new SuppliersResource($this->whenLoaded('supplier')),
            'approver' => new \App\Http\Resources\UsersRoles\UsersResource($this->whenLoaded('approvedBy')),
            'grns' => GrnResource::collection($this->whenLoaded('grns')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
