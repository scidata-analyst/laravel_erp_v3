<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Dashboard extends Model
{
    use HasFactory;
    protected $fillable = [
        'widget_config',
        'layout_preferences',
        'theme',
        'language',
        'timezone',
        'default_date_range',
        'refresh_interval',
        'user_id',
        'is_default',
        'dashboard_type'
    ];

    protected $casts = [
        'widget_config' => 'array',
        'layout_preferences' => 'array',
        'is_default' => 'boolean',
        'refresh_interval' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    public function isDefault(): bool
    {
        return $this->is_default === true;
    }

    public function isCustom(): bool
    {
        return $this->is_default === false;
    }

    public function isSalesDashboard(): bool
    {
        return $this->dashboard_type === 'sales';
    }

    public function isFinancialDashboard(): bool
    {
        return $this->dashboard_type === 'financial';
    }

    public function isOperationalDashboard(): bool
    {
        return $this->dashboard_type === 'operational';
    }

    public function isHrDashboard(): bool
    {
        return $this->dashboard_type === 'hr';
    }

    public function getWidgetCountAttribute(): int
    {
        if (is_array($this->widget_config)) {
            return count($this->widget_config);
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

    public function getFormattedDateRangeAttribute(): string
    {
        return $this->default_date_range ?? 'Last 30 Days';
    }
}
