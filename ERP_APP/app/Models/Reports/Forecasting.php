<?php

namespace App\Models\Reports;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Forecasting extends Model
{
    use HasFactory;
    protected $fillable = [
        'forecast_name',
        'name',
        'forecast_type',
        'model_type',
        'period_type',
        'start_date',
        'period_from',
        'end_date',
        'period_to',
        'base_data_source',
        'data_source',
        'growth_rate',
        'seasonal_factor',
        'confidence_level',
        'forecast_data',
        'created_by',
        'status'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'growth_rate' => 'decimal:2',
        'seasonal_factor' => 'decimal:2',
        'confidence_level' => 'decimal:2',
        'forecast_data' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'created_by');
    }

    public function isSalesForecast(): bool
    {
        return $this->forecast_type === 'sales';
    }

    public function isInventoryForecast(): bool
    {
        return $this->forecast_type === 'inventory';
    }

    public function isRevenueForecast(): bool
    {
        return $this->forecast_type === 'revenue';
    }

    public function isExpenseForecast(): bool
    {
        return $this->forecast_type === 'expense';
    }

    public function isHighConfidence(): bool
    {
        return $this->confidence_level >= 0.8;
    }

    public function isMediumConfidence(): bool
    {
        return $this->confidence_level >= 0.6 && $this->confidence_level < 0.8;
    }

    public function isLowConfidence(): bool
    {
        return $this->confidence_level < 0.6;
    }

    public function getForecastPeriodAttribute(): string
    {
        return $this->start_date->format('M Y') . ' - ' . $this->end_date->format('M Y');
    }

    public function getAccuracyAttribute(): float
    {
        // This would be calculated based on actual vs forecast comparison
        return 0.0; // Placeholder
    }

    public function getNameAttribute(): string
    {
        return (string) $this->forecast_name;
    }

    public function setNameAttribute(?string $value): void
    {
        $this->attributes['forecast_name'] = $value;
    }

    public function getModelTypeAttribute(): string
    {
        return (string) $this->forecast_type;
    }

    public function setModelTypeAttribute(?string $value): void
    {
        $this->attributes['forecast_type'] = $value;
    }

    public function getPeriodFromAttribute(): ?string
    {
        return $this->start_date?->toDateString();
    }

    public function setPeriodFromAttribute(?string $value): void
    {
        $this->attributes['start_date'] = $value;
    }

    public function getPeriodToAttribute(): ?string
    {
        return $this->end_date?->toDateString();
    }

    public function setPeriodToAttribute(?string $value): void
    {
        $this->attributes['end_date'] = $value;
    }

    public function getDataSourceAttribute(): ?string
    {
        return $this->base_data_source;
    }

    public function setDataSourceAttribute(?string $value): void
    {
        $this->attributes['base_data_source'] = $value;
    }
}
