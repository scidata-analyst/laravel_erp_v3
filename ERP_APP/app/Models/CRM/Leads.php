<?php

namespace App\Models\CRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Leads extends Model
{
    use HasFactory;
    protected $fillable = [
        'lead_name',
        'name',
        'company',
        'email',
        'phone',
        'deal_value',
        'estimated_value',
        'stage',
        'assigned_to',
        'next_action_date',
        'source',
        'probability',
        'notes',
        'status'
    ];

    protected $casts = [
        'deal_value' => 'decimal:2',
        'probability' => 'integer',
        'next_action_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function assignedUser(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'assigned_to');
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Sales\Customers::class, 'company');
    }

    public function getNameAttribute(): string
    {
        return (string) $this->lead_name;
    }

    public function setNameAttribute(?string $value): void
    {
        $this->attributes['lead_name'] = $value;
    }

    public function getEstimatedValueAttribute(): float
    {
        return (float) $this->deal_value;
    }

    public function setEstimatedValueAttribute($value): void
    {
        $this->attributes['deal_value'] = $value;
    }
}
