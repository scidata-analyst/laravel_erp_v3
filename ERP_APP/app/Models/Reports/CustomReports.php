<?php

namespace App\Models\Reports;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CustomReports extends Model
{
    use HasFactory;
    protected $fillable = [
        'report_name',
        'name',
        'report_type',
        'type',
        'description',
        'query_sql',
        'query',
        'parameters',
        'filter_by',
        'schedule',
        'recipients',
        'format_type',
        'format',
        'created_by',
        'last_run_date',
        'status'
    ];

    protected $casts = [
        'parameters' => 'array',
        'recipients' => 'array',
        'last_run_date' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'created_by');
    }

    public function isScheduled(): bool
    {
        return $this->schedule !== null && $this->schedule !== '';
    }

    public function isFinancialReport(): bool
    {
        return $this->report_type === 'financial';
    }

    public function isSalesReport(): bool
    {
        return $this->report_type === 'sales';
    }

    public function isInventoryReport(): bool
    {
        return $this->report_type === 'inventory';
    }

    public function isHrReport(): bool
    {
        return $this->report_type === 'hr';
    }

    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    public function isPdfFormat(): bool
    {
        return $this->format_type === 'pdf';
    }

    public function isExcelFormat(): bool
    {
        return $this->format_type === 'excel';
    }

    public function getCronExpressionAttribute(): string
    {
        return $this->schedule ?? '';
    }

    public function getNameAttribute(): string
    {
        return (string) $this->report_name;
    }

    public function setNameAttribute(?string $value): void
    {
        $this->attributes['report_name'] = $value;
    }

    public function getTypeAttribute(): string
    {
        return (string) $this->report_type;
    }

    public function setTypeAttribute(?string $value): void
    {
        $this->attributes['report_type'] = $value;
    }

    public function getQueryAttribute(): ?string
    {
        return $this->query_sql;
    }

    public function setQueryAttribute(?string $value): void
    {
        $this->attributes['query_sql'] = $value;
    }

    public function getFormatAttribute(): ?string
    {
        return $this->format_type;
    }

    public function setFormatAttribute(?string $value): void
    {
        $this->attributes['format_type'] = $value;
    }
}
