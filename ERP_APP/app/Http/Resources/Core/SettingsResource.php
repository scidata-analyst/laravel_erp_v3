<?php

namespace App\Http\Resources\Core;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SettingsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'company_name' => $this->company_name,
            'company_email' => $this->company_email,
            'phone_number' => $this->phone_number,
            'address' => $this->address,
            'country' => $this->country,
            'session_timeout_minutes' => $this->session_timeout_minutes,
            'two_factor_auth_enabled' => $this->two_factor_auth_enabled,
            'password_policy' => $this->password_policy,
            'ip_whitelist' => $this->ip_whitelist,
            'email_notifications_enabled' => $this->email_notifications_enabled,
            'low_stock_threshold' => $this->low_stock_threshold,
            'alert_recipients' => $this->alert_recipients,
            'default_valuation_method' => $this->default_valuation_method,
            'auto_reorder_enabled' => $this->auto_reorder_enabled,
            'default_warehouse_id' => $this->default_warehouse_id,
            'status' => $this->status,
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
