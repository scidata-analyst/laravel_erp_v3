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
        'forecast_type',
        'period_type',
        'start_date',
        'end_date',
        'base_data_source',
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
        'forecast_data' => 'json',
    ];

}
