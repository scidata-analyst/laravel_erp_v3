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
        'description',
        'widgets',
        'layout_config',
        'data_sources',
        'refresh_interval',
        'access_level',
        'created_by',
        'is_public',
        'category',
        'status'
    ];

    protected $casts = [
        'widgets' => 'json',
        'layout_config' => 'json',
        'data_sources' => 'json',
        'is_public' => 'boolean',
    ];
}
