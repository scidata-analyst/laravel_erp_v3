<?php

namespace App\Models\QualityControl;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QcChecklists extends Model
{
    use HasFactory;
    protected $fillable = [
        'checklist_number',
        'work_order_id',
        'product_id',
        'name',
        'inspector_id',
        'inspection_type',
        'inspection_date',
        'sample_size',
        'items_checked',
        'items_passed',
        'pass_rate',
        'status',
        'checklist_items',
        'criteria',
        'notes'
    ];

    protected $casts = [
        'inspection_date' => 'date',
        'sample_size' => 'integer',
        'items_checked' => 'integer',
        'items_passed' => 'integer',
        'pass_rate' => 'decimal:2',
        'checklist_items' => 'json',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function inspector(): BelongsTo
    {
        return $this->belongsTo(\App\Models\HR\Employees::class, 'inspector_id');
    }

    public function workOrder(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Production\WorkOrders::class, 'work_order_id');
    }

    public function getComputedPassRateAttribute(): float
    {
        if ($this->items_checked > 0) {
            return ($this->items_passed / $this->items_checked) * 100;
        }
        return 0;
    }

    public function hasPassed(): bool
    {
        return $this->pass_rate >= 100;
    }

    public function getNameAttribute(): string
    {
        return (string) $this->checklist_number;
    }

    public function setNameAttribute(?string $value): void
    {
        $this->attributes['checklist_number'] = $value;
    }

    public function getCriteriaAttribute()
    {
        return $this->checklist_items;
    }

    public function setCriteriaAttribute($value): void
    {
        $this->attributes['checklist_items'] = is_array($value) ? json_encode($value) : $value;
    }
}
