<?php

namespace App\Models\HR;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Performance extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'department',
        'review_period',
        'kpi_score',
        'goal_achievement',
        'rating',
        'status',
        'comments',
    ];
}
