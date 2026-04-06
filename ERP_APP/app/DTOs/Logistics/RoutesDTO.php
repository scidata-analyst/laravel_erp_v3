<?php

namespace App\DTOs\Logistics;

class RoutesDTO
{
    public readonly string $route_name;
    public readonly string $start_location;
    public readonly string $end_location;
    public readonly ?float $route_distance;
    public readonly ?float $estimated_duration;
    public readonly ?float $fuel_consumed;
    public readonly ?string $status;

    public function __construct(array $data)
    {
        $this->route_name = $data['route_name'] ?? $data['name'] ?? '';
        $this->start_location = $data['start_location'] ?? $data['origin'] ?? '';
        $this->end_location = $data['end_location'] ?? $data['destination'] ?? '';
        $this->route_distance = isset($data['route_distance']) ? (float)$data['route_distance'] 
            : (isset($data['distance']) ? (float)$data['distance'] 
            : (isset($data['distance_km']) ? (float)$data['distance_km'] : null));
        $this->estimated_duration = isset($data['estimated_duration']) ? (float)$data['estimated_duration'] 
            : (isset($data['estimated_time']) ? (float)$data['estimated_time'] 
            : (isset($data['estimated_duration_minutes']) ? (float)$data['estimated_duration_minutes'] : null));
        $this->fuel_consumed = isset($data['fuel_consumed']) ? (float)$data['fuel_consumed'] 
            : (isset($data['cost']) ? (float)$data['cost'] : null);
        $this->status = $data['status'] ?? 'Active';
    }
}