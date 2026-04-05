<?php

namespace App\DTOs\Logistics;

class ShipmentsDTO
{
    public function __construct(
        public readonly string $shipment_number,
        public readonly ?int $sales_order_id = null,
        public readonly ?string $carrier = null,
        public readonly ?string $tracking_number = null,
        public readonly ?string $origin = null,
        public readonly ?string $destination = null,
        public readonly ?string $shipped_date = null,
        public readonly ?string $estimated_arrival = null,
        public readonly ?string $est_delivery_date = null,
        public readonly ?string $actual_delivery_date = null,
        public readonly ?string $shipping_address = null,
        public readonly ?string $status = 'Pending',
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            shipment_number: $data['shipment_number'],
            sales_order_id: isset($data['sales_order_id']) ? (int) $data['sales_order_id'] : (isset($data['order_id']) ? (int) $data['order_id'] : null),
            carrier: $data['carrier'] ?? $data['carrier_name'] ?? null,
            tracking_number: $data['tracking_number'] ?? null,
            origin: $data['origin'] ?? null,
            destination: $data['destination'] ?? $data['shipping_address'] ?? null,
            shipped_date: $data['shipped_date'] ?? $data['actual_delivery_date'] ?? $data['shipping_date'] ?? null,
            estimated_arrival: $data['estimated_arrival'] ?? $data['est_delivery_date'] ?? $data['delivery_date'] ?? null,
            est_delivery_date: $data['est_delivery_date'] ?? $data['estimated_arrival'] ?? $data['delivery_date'] ?? null,
            actual_delivery_date: $data['actual_delivery_date'] ?? $data['shipped_date'] ?? $data['shipping_date'] ?? null,
            shipping_address: $data['shipping_address'] ?? $data['destination'] ?? null,
            status: $data['status'] ?? 'Pending',
        );
    }

    public function toArray(): array
    {
        return [
            'shipment_number' => $this->shipment_number,
            'sales_order_id' => $this->sales_order_id,
            'carrier' => $this->carrier,
            'tracking_number' => $this->tracking_number,
            'origin' => $this->origin,
            'destination' => $this->destination,
            'shipped_date' => $this->shipped_date,
            'estimated_arrival' => $this->estimated_arrival,
            'est_delivery_date' => $this->est_delivery_date,
            'actual_delivery_date' => $this->actual_delivery_date,
            'shipping_address' => $this->shipping_address,
            'status' => $this->status,
        ];
    }
}
