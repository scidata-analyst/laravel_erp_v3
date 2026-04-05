<?php

namespace App\Models\Logistics;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Routes extends Model
{
    use HasFactory;

    protected $fillable = [
        'route_name',
        'name',
        'driver_id',
        'vehicle_number',
        'start_location',
        'origin',
        'end_location',
        'destination',
        'route_distance',
        'distance',
        'estimated_duration',
        'estimated_time',
        'actual_duration',
        'fuel_consumed',
        'cost',
        'delivery_count',
        'status',
        'route_date',
        'notes'
    ];

    protected $casts = [
        'route_distance' => 'decimal:2',
        'estimated_duration' => 'decimal:2',
        'actual_duration' => 'decimal:2',
        'fuel_consumed' => 'decimal:2',
        'delivery_count' => 'integer',
        'route_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function driver(): BelongsTo
    {
        return $this->belongsTo(\App\Models\HR\Employees::class, 'driver_id');
    }

    public function shipments(): HasMany
    {
        return $this->hasMany(Shipments::class, 'route_id');
    }

    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    public function isInProgress(): bool
    {
        return $this->status === 'in_progress';
    }

    public function getEfficiencyAttribute(): float
    {
        if ($this->estimated_duration > 0) {
            return ($this->estimated_duration / $this->actual_duration) * 100;
        }
        return 0;
    }

    public function getFuelEfficiencyAttribute(): float
    {
        if ($this->route_distance > 0) {
            return $this->fuel_consumed / $this->route_distance;
        }
        return 0;
    }

    public function getNameAttribute(): string
    {
        return (string) $this->route_name;
    }

    public function setNameAttribute(?string $value): void
    {
        $this->attributes['route_name'] = $value;
    }

    public function getOriginAttribute(): ?string
    {
        return $this->start_location;
    }

    public function setOriginAttribute(?string $value): void
    {
        $this->attributes['start_location'] = $value;
    }

    public function getDestinationAttribute(): ?string
    {
        return $this->end_location;
    }

    public function setDestinationAttribute(?string $value): void
    {
        $this->attributes['end_location'] = $value;
    }

    public function getDistanceAttribute(): float
    {
        return (float) $this->route_distance;
    }

    public function setDistanceAttribute($value): void
    {
        $this->attributes['route_distance'] = $value;
    }

    public function getEstimatedTimeAttribute(): float
    {
        return (float) $this->estimated_duration;
    }

    public function setEstimatedTimeAttribute($value): void
    {
        $this->attributes['estimated_duration'] = $value;
    }

    public function getCostAttribute(): float
    {
        return (float) $this->fuel_consumed;
    }

    public function setCostAttribute($value): void
    {
        $this->attributes['fuel_consumed'] = $value;
    }
}
