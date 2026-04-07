<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Dashboard extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'widget_config',
        'layout_preferences',
        'theme',
        'language',
        'timezone',
        'default_date_range',
        'refresh_interval',
        'is_default',
        'dashboard_type'
    ];

    protected $casts = [
        'widget_config' => 'json',
        'layout_preferences' => 'json',
        'is_default' => 'boolean',
    ];
}
