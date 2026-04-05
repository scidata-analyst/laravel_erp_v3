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
        'widget_name',
        'widget_type',
        'data_source',
        'refresh_rate',
        'dashboard',
        'created_by',
    ];
}
