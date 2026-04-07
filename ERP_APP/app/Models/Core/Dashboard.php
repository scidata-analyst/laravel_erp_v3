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
        'layout_preference',
        'theme',
        'language',
        'timezone',
        'default_date_range',
        'refresh_interval',
        'user_id',
        'is_default',
        'dashboard_type',
    ];
}
