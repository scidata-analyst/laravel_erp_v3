<?php

namespace App\Models\Production;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Machines extends Model
{
    use HasFactory;
    protected $fillable = [
        'machine_name',
        'machine_code',
        'machine_type',
        'manufacturer',
        'model',
        'warehouse_id',
        'status'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function warehouse(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Logistics\Warehouses::class, 'warehouse_id');
    }

    public function machineLabor(): HasMany
    {
        return $this->hasMany(\App\Models\Production\MachineLabor::class, 'machine_id');
    }

    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    public function isUnderMaintenance(): bool
    {
        return $this->status === 'maintenance';
    }

    public function isOutOfOrder(): bool
    {
        return $this->status === 'out_of_order';
    }
}