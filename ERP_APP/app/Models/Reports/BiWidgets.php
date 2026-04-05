<?php

namespace App\Models\Reports;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BiWidgets extends Model
{
    use HasFactory;
    protected $fillable = [
        'widget_name',
        'widget_type',
        'dashboard_id',
        'data_source',
        'query_config',
        'visualization_type',
        'position_x',
        'position_y',
        'width',
        'height',
        'refresh_interval',
        'settings'
    ];

    protected $casts = [
        'query_config' => 'array',
        'settings' => 'array',
        'position_x' => 'integer',
        'position_y' => 'integer',
        'width' => 'integer',
        'height' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function dashboard(): BelongsTo
    {
        return $this->belongsTo(BiDashboards::class, 'dashboard_id');
    }

    public function isChart(): bool
    {
        return $this->widget_type === 'chart';
    }

    public function isTable(): bool
    {
        return $this->widget_type === 'table';
    }

    public function isKpi(): bool
    {
        return $this->widget_type === 'kpi';
    }

    public function isGauge(): bool
    {
        return $this->widget_type === 'gauge';
    }

    public function isLineChart(): bool
    {
        return $this->visualization_type === 'line';
    }

    public function isBarChart(): bool
    {
        return $this->visualization_type === 'bar';
    }

    public function isPieChart(): bool
    {
        return $this->visualization_type === 'pie';
    }

    public function getPositionAttribute(): array
    {
        return [
            'x' => $this->position_x,
            'y' => $this->position_y
        ];
    }

    public function getSizeAttribute(): array
    {
        return [
            'width' => $this->width,
            'height' => $this->height
        ];
    }
}
