<?php

namespace App\DTOs\Logistics;

class WarehousesDTO
{
    public readonly string $warehouse_name;
    public readonly ?string $code;
    public readonly ?string $type;
    public readonly ?string $location_address;
    public readonly ?string $manager;
    public readonly ?int $manager_id;
    public readonly ?int $capacity_units;
    public readonly ?string $status;
    public readonly ?string $contact_phone;
    public readonly ?string $email;

    public function __construct(array $data)
    {
        $this->warehouse_name = $data['warehouse_name'] ?? $data['name'] ?? '';
        $this->code = $data['code'] ?? null;
        $this->type = $data['type'] ?? null;
        $this->location_address = $data['location_address'] ?? $data['location'] ?? $data['address'] ?? null;
        $this->manager = $data['manager'] ?? null;
        $this->manager_id = isset($data['manager_id']) ? (int) $data['manager_id'] : null;
        $this->capacity_units = isset($data['capacity_units']) ? (int) $data['capacity_units'] : (isset($data['capacity']) ? (int) $data['capacity'] : 0);
        $this->status = $data['status'] ?? 'Active';
        $this->contact_phone = $data['contact_phone'] ?? $data['contact_number'] ?? null;
        $this->email = $data['email'] ?? null;
    }
}