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
        'zone',
        'driver',
        'vehicle',
        'stops',
        'avg_time',
        'status',
        'route_description',
    ];
}
