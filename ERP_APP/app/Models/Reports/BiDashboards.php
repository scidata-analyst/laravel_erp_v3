<?php

namespace App\Models\Reports;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BiDashboards extends Model
{
    use HasFactory;
    protected $fillable = [
        'dashboard_name',
        'name',
        'description',
        'widgets',
        'layout',
        'layout_config',
        'data_sources',
        'refresh_interval',
        'refresh_rate',
        'access_level',
        'created_by',
        'is_public',
        'category',
        'status'
    ];

    protected $casts = [
        'widgets' => 'array',
        'layout_config' => 'array',
        'data_sources' => 'array',
        'is_public' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'created_by');
    }

    public function widgets(): HasMany
    {
        return $this->hasMany(\App\Models\Reports\BiWidgets::class, 'dashboard_id');
    }

    public function isPublic(): bool
    {
        return $this->is_public === true;
    }

    public function isPrivate(): bool
    {
        return $this->is_public === false;
    }

    public function isExecutiveLevel(): bool
    {
        return $this->access_level === 'executive';
    }

    public function isManagerLevel(): bool
    {
        return $this->access_level === 'manager';
    }

    public function isEmployeeLevel(): bool
    {
        return $this->access_level === 'employee';
    }

    public function isSalesDashboard(): bool
    {
        return $this->category === 'sales';
    }

    public function isFinancialDashboard(): bool
    {
        return $this->category === 'financial';
    }

    public function isOperationalDashboard(): bool
    {
        return $this->category === 'operational';
    }

    public function getWidgetCountAttribute(): int
    {
        if (is_array($this->widgets)) {
            return count($this->widgets);
        }
        return 0;
    }

    public function getFormattedRefreshIntervalAttribute(): string
    {
        $interval = $this->refresh_interval ?? 0;

        if ($interval < 60) {
            return $interval . ' seconds';
        } elseif ($interval < 3600) {
            return ($interval / 60) . ' minutes';
        } else {
            return ($interval / 3600) . ' hours';
        }
    }

    public function getNameAttribute(): string
    {
        return (string) $this->dashboard_name;
    }

    public function setNameAttribute(?string $value): void
    {
        $this->attributes['dashboard_name'] = $value;
    }

    public function getLayoutAttribute()
    {
        return $this->layout_config;
    }

    public function setLayoutAttribute($value): void
    {
        $this->attributes['layout_config'] = is_array($value) ? json_encode($value) : $value;
    }

    public function getRefreshRateAttribute()
    {
        return $this->refresh_interval;
    }

    public function setRefreshRateAttribute($value): void
    {
        $this->attributes['refresh_interval'] = $value;
    }
}
