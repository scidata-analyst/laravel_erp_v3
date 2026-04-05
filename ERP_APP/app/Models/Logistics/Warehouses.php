<?php

namespace App\Models\Logistics;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Warehouses extends Model
{
    use HasFactory;

    protected $fillable = [
        'warehouse_name',
        'name',
        'code',
        'type',
        'location_address',
        'location',
        'manager_id',
        'manager',
        'capacity_units',
        'capacity',
        'used_units',
        'status',
        'contact_phone',
        'email'
    ];

    protected $casts = [
        'capacity_units' => 'integer',
        'used_units' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function manager(): BelongsTo
    {
        return $this->belongsTo(\App\Models\HR\Employees::class, 'manager_id');
    }

    public function stockMovements(): HasMany
    {
        return $this->hasMany(\App\Models\Inventory\StockMovements::class, 'from_warehouse', 'code');
    }

    public function products(): HasMany
    {
        return $this->hasMany(\App\Models\Inventory\ProductCatalog::class, 'warehouse', 'code');
    }

    public function getUtilizationPercentageAttribute(): float
    {
        if ($this->capacity_units > 0) {
            return ($this->used_units / $this->capacity_units) * 100;
        }
        return 0;
    }

    public function getNameAttribute(): string
    {
        return (string) $this->warehouse_name;
    }

    public function setNameAttribute(?string $value): void
    {
        $this->attributes['warehouse_name'] = $value;
    }

    public function getLocationAttribute(): ?string
    {
        return $this->location_address;
    }

    public function setLocationAttribute(?string $value): void
    {
        $this->attributes['location_address'] = $value;
    }

    public function getCapacityAttribute(): int
    {
        return (int) $this->capacity_units;
    }

    public function setCapacityAttribute($value): void
    {
        $this->attributes['capacity_units'] = $value;
    }
}
