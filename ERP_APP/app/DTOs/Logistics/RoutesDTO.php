<?php

namespace App\DTOs\Logistics;

use App\Models\Logistics\Routes;

/**
 * Data Transfer Object for Routes entity.
 *
 * Used for type-safe data transfer between layers
 * and encapsulates delivery route data.
 *
 * @property int|null $id
 * @property string|null $routeName
 * @property string|null $zoneArea
 * @property string|null $driverName
 * @property string|null $vehicleId
 * @property int|null $numberOfStops
 * @property string|null $routeDescription
 * @property int|null $status
 * @property string|null $createdAt
 * @property string|null $updatedAt
 */
class RoutesDTO
{
    /** @var int|null Unique identifier */
    public ?int $id;

    /** @var string|null Route name (e.g., 'Morning Shift - Zone A') */
    public ?string $routeName;

    /** @var string|null Geographic zone or area (e.g., 'North District', 'City Center') */
    public ?string $zoneArea;

    /** @var string|null Assigned driver name */
    public ?string $driverName;

    /** @var string|null Vehicle ID/plate number */
    public ?string $vehicleId;

    /** @var int|null Number of delivery stops on this route */
    public ?int $numberOfStops;

    /** @var string|null Description or notes about the route */
    public ?string $routeDescription;

    /** @var int|null Status: 0=Inactive, 1=Active, 2=OnHold */
    public ?int $status;

    /** @var string|null Creation timestamp (ISO 8601) */
    public ?string $createdAt;

    /** @var string|null Last update timestamp (ISO 8601) */
    public ?string $updatedAt;

    /**
     * Create a new RoutesDTO instance.
     *
     * @param array $data Optional data array for initialization
     */
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

    /**
     * Create DTO from Eloquent model instance.
     *
     * @param Routes $model Eloquent model to convert
     * @return self New DTO instance with model data
     */
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

    /**
     * Create DTO from plain array data.
     *
     * @param array $data Associative array with DTO properties
     * @return self New DTO instance
     */
    public static function fromArray(array $data): self
    {
        return new self($data);
    }

    /**
     * Convert DTO to array representation.
     *
     * @return array Array with snake_case keys matching database columns
     */
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

    /**
     * Convert DTO to array for Eloquent model creation/update.
     *
     * Returns fillable attributes only, excluding timestamps
     * and foreign keys for related models.
     *
     * @return array Associative array for model mass assignment
     */
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
