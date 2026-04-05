<?php

namespace App\Http\Resources\CRM;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SupportResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'ticket_number' => $this->ticket_number,
            'customer_id' => $this->customer_id,
            'subject' => $this->subject,
            'description' => $this->description,
            'priority' => $this->priority,
            'status' => $this->status,
            'category' => $this->category,
            'lead_id' => $this->lead_id,
            'assigned_to' => $this->assigned_to,
            'resolution' => $this->resolution,
            'resolution_date' => $this->resolution_date,
            'customer' => new \App\Http\Resources\Sales\CustomersResource($this->whenLoaded('customer')),
            'lead' => new LeadsResource($this->whenLoaded('lead')),
            'assigned_user' => new \App\Http\Resources\UsersRoles\UsersResource($this->whenLoaded('assignedTo')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
