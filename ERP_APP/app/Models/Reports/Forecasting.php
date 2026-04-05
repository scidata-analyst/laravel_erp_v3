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
        'type',
        'model',
        'period',
        'accuracy',
        'generated_at',
        'status',
        'period_start',
        'period_end',
        'model'
    ];

}
