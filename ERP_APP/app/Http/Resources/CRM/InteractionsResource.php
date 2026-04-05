<?php

namespace App\Http\Resources\CRM;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InteractionsResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'lead_id' => $this->lead_id,
            'customer_id' => $this->customer_id,
            'sales_order_id' => $this->sales_order_id,
            'support_ticket_id' => $this->support_ticket_id,
            'interaction_type' => $this->interaction_type,
            'interaction_date' => $this->interaction_date,
            'subject' => $this->subject,
            'description' => $this->description,
            'next_action' => $this->next_action,
            'next_action_date' => $this->next_action_date,
            'assigned_to' => $this->assigned_to,
            'status' => $this->status,
            'lead' => new LeadsResource($this->whenLoaded('lead')),
            'customer' => new \App\Http\Resources\Sales\CustomersResource($this->whenLoaded('customer')),
            'sales_order' => new \App\Http\Resources\Sales\SalesOrdersResource($this->whenLoaded('salesOrder')),
            'support_ticket' => new SupportResource($this->whenLoaded('supportTicket')),
            'assigned_user' => new \App\Http\Resources\UsersRoles\UsersResource($this->whenLoaded('assignedTo')),
            'created_by_user' => new \App\Http\Resources\UsersRoles\UsersResource($this->whenLoaded('createdBy')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
