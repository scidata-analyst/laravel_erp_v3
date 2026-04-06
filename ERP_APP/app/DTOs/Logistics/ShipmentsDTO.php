<?php

namespace App\DTOs\Logistics;

class ShipmentsDTO
{
    public readonly string $shipment;
    public readonly ?string $sales_order;
    public readonly ?string $customer;
    public readonly ?string $currier;
    public readonly ?string $tracking_number;
    public readonly ?string $estimated_delivery;
    public readonly ?string $status;
    public readonly ?string $shipping_address;

    public function __construct(array $data)
    {
        $this->shipment = $data['shipment'] ?? '';
        $this->sales_order = $data['sales_order'] ?? null;
        $this->customer = $data['customer'] ?? null;
        $this->currier = $data['currier'] ?? null;
        $this->tracking_number = $data['tracking_number'] ?? null;
        $this->estimated_delivery = $data['estimated_delivery'] ?? null;
        $this->status = $data['status'] ?? 'Pending';
        $this->shipping_address = $data['shipping_address'] ?? null;
    }
}