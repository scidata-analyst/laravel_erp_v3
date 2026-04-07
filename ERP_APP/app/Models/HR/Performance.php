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
        'review_period',
        'kpi_score',
        'goal_achievement',
        'overall_rating',
        'reviewer_id',
        'reviewer_comments',
        'review_date',
        'status',
        'improvement_plan'
    ];

    protected $casts = [
        'kpi_score' => 'decimal:2',
        'goal_achievement' => 'decimal:2',
        'review_date' => 'date',
        'improvement_plan' => 'json',
    ];
}
