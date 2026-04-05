<?php

namespace App\Models\QualityControl;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Defects extends Model
{
    use HasFactory;
    protected $fillable = [
        'defect_number',
        'product_id',
        'batch_number',
        'defect_type',
        'severity',
        'description',
        'detected_by',
        'detection_date',
        'status',
        'resolution',
        'resolution_date',
        'cost_impact',
        'affected_quantity',
        'compliance_id'
    ];

    protected $casts = [
        'detection_date' => 'date',
        'resolution_date' => 'date',
        'cost_impact' => 'decimal:2',
        'affected_quantity' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Inventory\ProductCatalog::class, 'product_id');
    }

    public function detectedBy(): BelongsTo
    {
        return $this->belongsTo(\App\Models\HR\Employees::class, 'detected_by');
    }

    public function qcChecklists(): HasMany
    {
        return $this->hasMany(QcChecklists::class, 'defect_id');
    }

    public function compliance(): BelongsTo
    {
        return $this->belongsTo(Compliance::class, 'compliance_id');
    }

    public function isCritical(): bool
    {
        return $this->severity === 'critical';
    }

    public function isHigh(): bool
    {
        return $this->severity === 'high';
    }

    public function isMedium(): bool
    {
        return $this->severity === 'medium';
    }

    public function isLow(): bool
    {
        return $this->severity === 'low';
    }

    public function isResolved(): bool
    {
        return $this->status === 'resolved';
    }

    public function isOpen(): bool
    {
        return $this->status === 'open';
    }

    public function getFormattedCostImpactAttribute(): string
    {
        return '$' . number_format((float) $this->cost_impact, 2);
    }
}
