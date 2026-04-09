<?php

namespace App\DTOs\Logistics;

use App\Models\Logistics\Routes;

class RoutesDTO
{
    public ?int $id;

    public ?string $routeName;

    public ?string $zoneArea;

    public ?string $driverName;

    public ?string $vehicleId;

    public ?int $numberOfStops;

    public ?string $routeDescription;

    public ?int $status;

    public ?string $createdAt;

    public ?string $updatedAt;

    public function __construct(array $data = [])
    {
        $this->id = isset($data['id']) ? (int) $data['id'] : null;
        $this->routeName = $data['route_name'] ?? null;
        $this->zoneArea = $data['zone_area'] ?? null;
        $this->driverName = $data['driver_name'] ?? null;
        $this->vehicleId = $data['vehicle_id'] ?? null;
        $this->numberOfStops = isset($data['number_of_stops']) ? (int) $data['number_of_stops'] : null;
        $this->routeDescription = $data['route_description'] ?? null;
        $this->status = isset($data['status']) ? (int) $data['status'] : null;
        $this->createdAt = $data['created_at'] ?? null;
        $this->updatedAt = $data['updated_at'] ?? null;
    }

    public static function fromModel(Routes $model): self
    {
        return new self([
            'id' => $model->id,
            'route_name' => $model->route_name,
            'zone_area' => $model->zone_area,
            'driver_name' => $model->driver_name,
            'vehicle_id' => $model->vehicle_id,
            'number_of_stops' => $model->number_of_stops,
            'route_description' => $model->route_description,
            'status' => $model->status,
            'created_at' => $model->created_at?->toIso8601String(),
            'updated_at' => $model->updated_at?->toIso8601String(),
        ]);
    }

    public static function fromArray(array $data): self
    {
        return new self($data);
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'route_name' => $this->routeName,
            'zone_area' => $this->zoneArea,
            'driver_name' => $this->driverName,
            'vehicle_id' => $this->vehicleId,
            'number_of_stops' => $this->numberOfStops,
            'route_description' => $this->routeDescription,
            'status' => $this->status,
            'created_at' => $this->createdAt,
            'updated_at' => $this->updatedAt,
        ];
    }

    public function toModel(): array
    {
        return [
            'route_name' => $this->routeName,
            'zone_area' => $this->zoneArea,
            'driver_name' => $this->driverName,
            'vehicle_id' => $this->vehicleId,
            'number_of_stops' => $this->numberOfStops,
            'route_description' => $this->routeDescription,
            'status' => $this->status,
        ];
    }
}
