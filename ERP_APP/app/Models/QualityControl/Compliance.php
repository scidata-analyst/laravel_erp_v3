<?php

namespace App\Models\QualityControl;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Compliance extends Model
{
    use HasFactory;
    protected $fillable = [
        'report_number',
        'compliance_type',
        'standard_name',
        'version',
        'standard_reference',
        'audit_date',
        'auditor_id',
        'findings',
        'risk_level',
        'corrective_actions',
        'due_date',
        'expiry_date',
        'completion_date',
        'status',
        'notes',
        'attachments'
    ];

    protected $casts = [
        'audit_date' => 'date',
        'due_date' => 'date',
        'completion_date' => 'date',
        'findings' => 'array',
        'corrective_actions' => 'array',
        'attachments' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function auditor(): BelongsTo
    {
        return $this->belongsTo(\App\Models\HR\Employees::class, 'auditor_id');
    }

    public function relatedDefects(): HasMany
    {
        return $this->hasMany(Defects::class, 'compliance_id');
    }

    public function isOverdue(): bool
    {
        return $this->due_date && now()->gt($this->due_date) && $this->status !== 'completed';
    }

    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    public function isInProgress(): bool
    {
        return $this->status === 'in_progress';
    }

    public function isHighRisk(): bool
    {
        return $this->risk_level === 'high';
    }

    public function isMediumRisk(): bool
    {
        return $this->risk_level === 'medium';
    }

    public function isLowRisk(): bool
    {
        return $this->risk_level === 'low';
    }

    public function getDaysUntilDueAttribute(): int
    {
        if ($this->due_date) {
            return max(0, now()->diffInDays($this->due_date));
        }
        return 0;
    }

    public function getFindingsCountAttribute(): int
    {
        if (is_array($this->findings)) {
            return count($this->findings);
        }
        return 0;
    }

    public function getStandardNameAttribute(): string
    {
        return (string) $this->standard_reference;
    }

    public function setStandardNameAttribute(?string $value): void
    {
        $this->attributes['standard_reference'] = $value;
    }

    public function getVersionAttribute(): ?string
    {
        return $this->compliance_type;
    }

    public function setVersionAttribute(?string $value): void
    {
        $this->attributes['compliance_type'] = $value;
    }

    public function getExpiryDateAttribute(): ?string
    {
        return $this->due_date?->toDateString();
    }

    public function setExpiryDateAttribute(?string $value): void
    {
        $this->attributes['due_date'] = $value;
    }
}
