<?php

namespace App\DTOs\Logistics;

class WarehousesDTO
{
    public function __construct(
        public readonly string $warehouse_name,
        public readonly ?string $code = null,
        public readonly ?string $type = null,
        public readonly ?string $location_address = null,
        public readonly ?string $manager = null,
        public readonly ?int $manager_id = null,
        public readonly ?int $capacity_units = 0,
        public readonly ?string $status = 'Active',
        public readonly ?string $contact_phone = null,
        public readonly ?string $email = null,
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            warehouse_name: $data['warehouse_name'] ?? $data['name'],
            code: $data['code'] ?? null,
            type: $data['type'] ?? null,
            location_address: $data['location_address'] ?? $data['location'] ?? $data['address'] ?? null,
            manager: $data['manager'] ?? null,
            manager_id: isset($data['manager_id']) ? (int) $data['manager_id'] : null,
            capacity_units: isset($data['capacity_units']) ? (int) $data['capacity_units'] : (isset($data['capacity']) ? (int) $data['capacity'] : 0),
            status: $data['status'] ?? 'Active',
            contact_phone: $data['contact_phone'] ?? $data['contact_number'] ?? null,
            email: $data['email'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'warehouse_name' => $this->warehouse_name,
            'code' => $this->code,
            'type' => $this->type,
            'location_address' => $this->location_address,
            'manager' => $this->manager,
            'manager_id' => $this->manager_id,
            'capacity_units' => $this->capacity_units,
            'status' => $this->status,
            'contact_phone' => $this->contact_phone,
            'email' => $this->email,
        ];
    }
}
