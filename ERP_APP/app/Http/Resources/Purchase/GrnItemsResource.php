<?php

namespace App\Http\Resources\Purchase;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GrnItemsResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'grn_id' => $this->grn_id,
            'product_name' => $this->product_name,
            'sku' => $this->sku,
            'quantity_ordered' => $this->quantity_ordered,
            'quantity_received' => $this->quantity_received,
            'unit_price' => $this->unit_price,
            'total_value' => $this->total_value,
            'batch_number' => $this->batch_number,
            'expiry_date' => $this->expiry_date,
            'notes' => $this->notes,
        ];
    }
}
