<?php

namespace App\Http\Resources\Ecommerce;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OnlineChannelsResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'channel_name' => $this->channel_name,
            'api_key' => '***', // Mask API keys in resources
            'sync_frequency' => $this->sync_frequency,
            'status' => $this->status,
            'last_sync_status' => $this->last_sync_status,
            'sync_history' => $this->whenLoaded('syncHistory'),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
