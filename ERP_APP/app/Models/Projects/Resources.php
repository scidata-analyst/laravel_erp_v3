<?php

namespace App\Models\Projects;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Resources extends Model
{
    use HasFactory;
    protected $fillable = [
        'project_id',
        'resource_name',
        'name',
        'resource_type',
        'allocation_percentage',
        'allocation',
        'start_date',
        'end_date',
        'cost_per_hour',
        'total_cost',
        'utilization_rate',
        'status'
    ];

    protected $casts = [
        'allocation_percentage' => 'integer',
        'start_date' => 'date',
        'end_date' => 'date',
        'cost_per_hour' => 'decimal:2',
        'total_cost' => 'decimal:2',
        'utilization_rate' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Tasks::class, 'project_id');
    }

    public function getNameAttribute(): string
    {
        return (string) $this->resource_name;
    }

    public function setNameAttribute(?string $value): void
    {
        $this->attributes['resource_name'] = $value;
    }

    public function getAllocationAttribute(): int
    {
        return (int) $this->allocation_percentage;
    }

    public function setAllocationAttribute($value): void
    {
        $this->attributes['allocation_percentage'] = $value;
    }
}
