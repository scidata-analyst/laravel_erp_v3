<?php

namespace App\Models\Projects;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProjectCost extends Model
{
    use HasFactory;
    protected $fillable = [
        'project_id',
        'cost_category',
        'category',
        'description',
        'budgeted_amount',
        'amount',
        'actual_amount',
        'variance',
        'currency',
        'cost_date',
        'date',
        'approved_by',
        'status'
    ];

    protected $casts = [
        'budgeted_amount' => 'decimal:2',
        'actual_amount' => 'decimal:2',
        'variance' => 'decimal:2',
        'cost_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Tasks::class, 'project_id');
    }

    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'approved_by');
    }

    public function getComputedVarianceAttribute(): float
    {
        return $this->actual_amount - $this->budgeted_amount;
    }

    public function getCategoryAttribute(): string
    {
        return (string) $this->cost_category;
    }

    public function setCategoryAttribute(?string $value): void
    {
        $this->attributes['cost_category'] = $value;
    }

    public function getAmountAttribute(): float
    {
        return (float) ($this->actual_amount ?? $this->budgeted_amount);
    }

    public function setAmountAttribute($value): void
    {
        $this->attributes['actual_amount'] = $value;
        $this->attributes['budgeted_amount'] = $value;
    }

    public function getDateAttribute(): ?string
    {
        return $this->cost_date?->toDateString();
    }

    public function setDateAttribute(?string $value): void
    {
        $this->attributes['cost_date'] = $value;
    }
}
