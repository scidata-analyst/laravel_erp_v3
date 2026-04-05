<?php

namespace App\DTOs\Logistics;

class RoutesDTO
{
    public function __construct(
        public readonly string $route_name,
        public readonly string $start_location,
        public readonly string $end_location,
        public readonly ?float $route_distance = null,
        public readonly ?float $estimated_duration = null,
        public readonly ?float $fuel_consumed = null,
        public readonly ?string $status = 'Active',
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            route_name: $data['route_name'] ?? $data['name'],
            start_location: $data['start_location'] ?? $data['origin'],
            end_location: $data['end_location'] ?? $data['destination'],
            route_distance: isset($data['route_distance']) ? (float) $data['route_distance'] : (isset($data['distance']) ? (float) $data['distance'] : (isset($data['distance_km']) ? (float) $data['distance_km'] : null)),
            estimated_duration: isset($data['estimated_duration']) ? (float) $data['estimated_duration'] : (isset($data['estimated_time']) ? (float) $data['estimated_time'] : (isset($data['estimated_duration_minutes']) ? (float) $data['estimated_duration_minutes'] : null)),
            fuel_consumed: isset($data['fuel_consumed']) ? (float) $data['fuel_consumed'] : (isset($data['cost']) ? (float) $data['cost'] : null),
            status: $data['status'] ?? 'Active',
        );
    }

    public function toArray(): array
    {
        return [
            'route_name' => $this->route_name,
            'start_location' => $this->start_location,
            'end_location' => $this->end_location,
            'route_distance' => $this->route_distance,
            'estimated_duration' => $this->estimated_duration,
            'fuel_consumed' => $this->fuel_consumed,
            'status' => $this->status,
        ];
    }
}
