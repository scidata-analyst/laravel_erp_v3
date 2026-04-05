<?php

namespace App\Models\Production;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WorkOrders extends Model
{
    use HasFactory;
    protected $fillable = [
        'wo_number',
        'product_bom_id',
        'product_id',
        'qty_to_produce',
        'quantity',
        'priority',
        'start_date',
        'end_date',
        'assigned_to',
        'status',
        'actual_qty_produced',
        'produced_qty',
        'scrap_quantity',
        'scrap_qty',
        'notes'
    ];

    protected $casts = [
        'qty_to_produce' => 'integer',
        'start_date' => 'date',
        'end_date' => 'date',
        'actual_qty_produced' => 'integer',
        'scrap_quantity' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function bom(): BelongsTo
    {
        return $this->belongsTo(Bom::class, 'product_bom_id');
    }

    public function machineLabor(): HasMany
    {
        return $this->hasMany(MachineLabor::class);
    }

    public function qcChecklists(): HasMany
    {
        return $this->hasMany(\App\Models\QualityControl\QcChecklists::class);
    }

    public function assignedWorkshop(): BelongsTo
    {
        return $this->belongsTo(\App\Models\HR\Employees::class, 'assigned_to');
    }

    public function getEfficiencyAttribute(): float
    {
        if ($this->qty_to_produce > 0) {
            return ($this->actual_qty_produced / $this->qty_to_produce) * 100;
        }
        return 0;
    }

    public function getProductIdAttribute()
    {
        return $this->product_bom_id;
    }

    public function setProductIdAttribute($value): void
    {
        $this->attributes['product_bom_id'] = $value;
    }

    public function getQuantityAttribute(): int
    {
        return (int) $this->qty_to_produce;
    }

    public function setQuantityAttribute($value): void
    {
        $this->attributes['qty_to_produce'] = $value;
    }

    public function getProducedQtyAttribute(): int
    {
        return (int) $this->actual_qty_produced;
    }

    public function setProducedQtyAttribute($value): void
    {
        $this->attributes['actual_qty_produced'] = $value;
    }

    public function getScrapQtyAttribute(): int
    {
        return (int) $this->scrap_quantity;
    }

    public function setScrapQtyAttribute($value): void
    {
        $this->attributes['scrap_quantity'] = $value;
    }
}
