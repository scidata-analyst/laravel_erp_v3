<?php

namespace App\Models\CRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Support extends Model
{
    use HasFactory;
    protected $fillable = [
        'ticket_number',
        'customer_id',
        'lead_id',
        'subject',
        'description',
        'priority',
        'category',
        'assigned_to',
        'status',
        'resolution',
        'resolution_date',
        'customer_satisfaction',
        'response_time_hours',
        'created_date',
        'last_response_date',
        'comments'
    ];

    protected $casts = [
        'customer_satisfaction' => 'integer',
        'response_time_hours' => 'decimal:2',
        'created_date' => 'datetime',
        'last_response_date' => 'datetime',
        'resolution_date' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Sales\Customers::class, 'customer_id');
    }

    public function lead(): BelongsTo
    {
        return $this->belongsTo(Leads::class, 'lead_id');
    }

    public function assignedTo(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'assigned_to');
    }

    public function interactions(): HasMany
    {
        return $this->hasMany(Interactions::class, 'support_ticket_id');
    }

    public function isOpen(): bool
    {
        return $this->status === 'open';
    }

    public function isClosed(): bool
    {
        return $this->status === 'closed';
    }

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function isResolved(): bool
    {
        return $this->status === 'resolved';
    }

    public function isHighPriority(): bool
    {
        return $this->priority === 'high';
    }

    public function isMediumPriority(): bool
    {
        return $this->priority === 'medium';
    }

    public function isLowPriority(): bool
    {
        return $this->priority === 'low';
    }

    public function isFirstResponse(): bool
    {
        return $this->last_response_date === null;
    }

    public function getResolutionTimeAttribute(): string
    {
        if ($this->created_date && $this->resolution_date) {
            $hours = $this->created_date->diffInHours($this->resolution_date);
            return $hours . ' hours';
        }
        return 'N/A';
    }

    public function getSatisfactionRatingAttribute(): string
    {
        $rating = $this->customer_satisfaction ?? 0;

        if ($rating >= 5) return 'Excellent';
        if ($rating >= 4) return 'Good';
        if ($rating >= 3) return 'Average';
        if ($rating >= 2) return 'Poor';
        return 'Very Poor';
    }

    public function getCommentsAttribute(): ?string
    {
        return $this->description;
    }

    public function setCommentsAttribute(?string $value): void
    {
        $this->attributes['description'] = $value;
    }
}
