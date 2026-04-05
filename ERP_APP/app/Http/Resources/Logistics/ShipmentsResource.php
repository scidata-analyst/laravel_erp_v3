<?php

namespace App\Http\Resources\Logistics;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShipmentsResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'shipment_number' => $this->shipment_number,
            'sales_order_id' => $this->sales_order_id,
            'customer' => $this->customer,
            'carrier' => $this->carrier,
            'tracking_number' => $this->tracking_number,
            'origin' => $this->origin,
            'destination' => $this->destination,
            'shipped_date' => $this->shipped_date,
            'estimated_arrival' => $this->estimated_arrival,
            'est_delivery_date' => $this->est_delivery_date,
            'actual_delivery_date' => $this->actual_delivery_date,
            'status' => $this->status,
            'shipping_address' => $this->shipping_address,
            'cost' => $this->cost,
            'notes' => $this->notes,
            'sales_order' => new \App\Http\Resources\Sales\SalesOrdersResource($this->whenLoaded('salesOrder')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
