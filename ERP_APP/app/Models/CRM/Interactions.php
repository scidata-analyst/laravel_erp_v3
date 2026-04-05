<?php

namespace App\Models\CRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Interactions extends Model
{
    use HasFactory;
    protected $fillable = [
        'interaction_type',
        'lead_id',
        'customer_id',
        'sales_order_id',
        'support_ticket_id',
        'interaction_date',
        'subject',
        'subject_type',
        'subject_id',
        'description',
        'notes',
        'next_action',
        'next_action_date',
        'assigned_to',
        'status',
        'created_by'
    ];

    protected $casts = [
        'interaction_date' => 'datetime',
        'next_action_date' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function lead(): BelongsTo
    {
        return $this->belongsTo(Leads::class, 'lead_id');
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Sales\Customers::class, 'customer_id');
    }

    public function salesOrder(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Sales\SalesOrders::class, 'sales_order_id');
    }

    public function supportTicket(): BelongsTo
    {
        return $this->belongsTo(Support::class, 'support_ticket_id');
    }

    public function assignedTo(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'assigned_to');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'created_by');
    }

    public function isEmail(): bool
    {
        return $this->interaction_type === 'email';
    }

    public function isPhone(): bool
    {
        return $this->interaction_type === 'phone';
    }

    public function isMeeting(): bool
    {
        return $this->interaction_type === 'meeting';
    }

    public function isNote(): bool
    {
        return $this->interaction_type === 'note';
    }

    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function isFollowUpRequired(): bool
    {
        return $this->next_action_date && now()->lt($this->next_action_date);
    }

    public function getInteractionDateFormattedAttribute(): string
    {
        return $this->interaction_date ? $this->interaction_date->format('M d, Y H:i') : '';
    }

    public function getNextActionDateFormattedAttribute(): string
    {
        return $this->next_action_date ? $this->next_action_date->format('M d, Y H:i') : '';
    }

    public function getDaysSinceInteractionAttribute(): int
    {
        if ($this->interaction_date) {
            return now()->diffInDays($this->interaction_date);
        }
        return 0;
    }

    public static function getInteractionTypes(): array
    {
        return ['email', 'phone', 'meeting', 'note', 'social_media', 'other'];
    }

    public function getTypeAttribute(): string
    {
        return (string) $this->interaction_type;
    }

    public function setTypeAttribute(?string $value): void
    {
        $this->attributes['interaction_type'] = $value;
    }

    public function getNotesAttribute(): ?string
    {
        return $this->description;
    }

    public function setNotesAttribute(?string $value): void
    {
        $this->attributes['description'] = $value;
    }

    public function getSubjectTypeAttribute(): ?string
    {
        if ($this->lead_id) {
            return 'lead';
        }

        if ($this->customer_id) {
            return 'customer';
        }

        if ($this->sales_order_id) {
            return 'sales_order';
        }

        if ($this->support_ticket_id) {
            return 'support';
        }

        return null;
    }

    public function setSubjectTypeAttribute(?string $value): void
    {
        $subjectId = $this->getSubjectIdAttribute();

        $this->attributes['lead_id'] = null;
        $this->attributes['customer_id'] = null;
        $this->attributes['sales_order_id'] = null;
        $this->attributes['support_ticket_id'] = null;

        if ($subjectId !== null) {
            $this->setSubjectIdAttribute($subjectId, $value);
        }
    }

    public function getSubjectIdAttribute()
    {
        return $this->lead_id
            ?? $this->customer_id
            ?? $this->sales_order_id
            ?? $this->support_ticket_id;
    }

    public function setSubjectIdAttribute($value, ?string $subjectType = null): void
    {
        $type = $subjectType ?? $this->getSubjectTypeAttribute();

        $this->attributes['lead_id'] = null;
        $this->attributes['customer_id'] = null;
        $this->attributes['sales_order_id'] = null;
        $this->attributes['support_ticket_id'] = null;

        match ($type) {
            'lead' => $this->attributes['lead_id'] = $value,
            'customer' => $this->attributes['customer_id'] = $value,
            'sales_order' => $this->attributes['sales_order_id'] = $value,
            'support' => $this->attributes['support_ticket_id'] = $value,
            default => null,
        };
    }
}
