<?php

namespace App\Models\Logistics;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Routes extends Model
{
    use HasFactory;

    protected $fillable = [
        'route_name',
        'driver_id',
        'vehicle_number',
        'start_location',
        'end_location',
        'route_distance',
        'estimated_duration',
        'actual_duration',
        'fuel_consumed',
        'delivery_count',
        'status',
        'route_date',
        'notes'
    ];

    protected $casts = [
        'route_distance' => 'decimal:2',
        'estimated_duration' => 'decimal:2',
        'actual_duration' => 'decimal:2',
        'fuel_consumed' => 'decimal:2',
        'route_date' => 'date',
    ];
}
