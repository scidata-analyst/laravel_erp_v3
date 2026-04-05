<?php

namespace App\Http\Resources\Ecommerce;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PosResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'terminal_id' => $this->terminal_name,
            'terminal_name' => $this->terminal_name,
            'location' => $this->location,
            'assigned_staff' => $this->current_user_id,
            'current_user_id' => $this->current_user_id,
            'last_sync' => optional($this->last_sync_date)->toDateTimeString(),
            'last_sync_date' => optional($this->last_sync_date)->toDateTimeString(),
            'status' => match ($this->status) {
                'active' => 'Online',
                'inactive' => 'Offline',
                'maintenance' => 'Closed',
                default => $this->status,
            },
            'status_key' => $this->status,
            'opening_balance' => $this->cash_drawer_balance,
            'cash_drawer_balance' => $this->cash_drawer_balance,
            'assigned_user' => new \App\Http\Resources\Auth\UserResource($this->whenLoaded('currentUser')),
            'transactions_count' => $this->whenLoaded('transactions', function () {
                return $this->transactions->count();
            }),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
