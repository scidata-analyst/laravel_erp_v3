<?php

namespace App\Models\Production;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Bom extends Model
{
    use HasFactory;
    protected $fillable = [
        'bom_number',
        'finished_product',
        'product_id',
        'name',
        'version',
        'lead_time_days',
        'estimated_cost',
        'status',
        'components',
        'notes'
    ];

    protected $casts = [
        'lead_time_days' => 'integer',
        'estimated_cost' => 'decimal:2',
        'components' => 'json',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function workOrders(): HasMany
    {
        return $this->hasMany(WorkOrders::class, 'product_bom_id');
    }

    public function getComponentsAttribute(): array
    {
        $value = $this->attributes['components'] ?? [];

        if (is_string($value)) {
            return json_decode($value, true) ?: [];
        }

        return is_array($value) ? $value : [];
    }

    public function setComponentsAttribute($value): void
    {
        $this->attributes['components'] = json_encode($value ?: []);
    }

    public function getNameAttribute(): string
    {
        return (string) $this->finished_product;
    }

    public function setNameAttribute(?string $value): void
    {
        $this->attributes['finished_product'] = $value;
    }

    public function getProductIdAttribute(): ?string
    {
        return $this->attributes['product_id'] ?? $this->finished_product;
    }

    public function setProductIdAttribute($value): void
    {
        $this->attributes['product_id'] = $value;
    }
}
