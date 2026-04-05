<?php

namespace App\Http\Resources\Ecommerce;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvSyncResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'terminal_id' => $this->terminal_id,
            'channel_id' => $this->channel_id,
            'sync_type' => $this->sync_type,
            'product_sku' => $this->product_sku,
            'product' => $this->whenLoaded('product', fn () => $this->product?->product_name),
            'online_quantity' => $this->online_quantity,
            'local_quantity' => $this->local_quantity,
            'records_synced' => $this->records_synced,
            'started_at' => $this->started_at,
            'completed_at' => $this->completed_at,
            'sync_date' => $this->sync_date,
            'status' => $this->status,
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}
