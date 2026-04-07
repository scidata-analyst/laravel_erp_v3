<?php

namespace App\Models\Projects;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Resources extends Model
{
    use HasFactory;
    protected $fillable = [
        'project_id',
        'resource_name',
        'resource_type',
        'allocation_percentage',
        'start_date',
        'end_date',
        'cost_per_hour',
        'total_cost',
        'utilization_rate',
        'status'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'cost_per_hour' => 'decimal:2',
        'total_cost' => 'decimal:2',
        'utilization_rate' => 'decimal:2',
    ];
}
