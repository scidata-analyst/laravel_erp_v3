<?php

namespace App\Http\Resources\Purchase;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GrnResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'grn_number' => $this->grn_number,
            'purchase_order_id' => $this->purchase_order_id,
            'supplier_id' => $this->supplier_id,
            'received_date' => $this->received_date,
            'received_by' => $this->received_by,
            'received_by_name' => $this->receivedBy?->name,
            'total_items' => $this->total_items,
            'total_quantity' => $this->total_quantity,
            'items' => GrnItemsResource::collection($this->whenLoaded('items')),
            'status' => $this->status,
            'notes' => $this->notes,
            'supplier_name' => $this->supplier?->company_name ?? $this->supplier?->name,
            'purchase_order_number' => $this->purchaseOrder?->po_number,
            'purchase_order' => new PurchaseOrdersResource($this->whenLoaded('purchaseOrder')),
            'supplier' => new SuppliersResource($this->whenLoaded('supplier')),
            'receiver' => new \App\Http\Resources\UsersRoles\UsersResource($this->whenLoaded('receivedBy')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
