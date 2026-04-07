<?php

namespace App\Models\Projects;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tasks extends Model
{
    use HasFactory;
    protected $fillable = [
        'project_name',
        'task_title',
        'description',
        'assigned_to',
        'start_date',
        'end_date',
        'priority',
        'status',
        'progress_percentage',
        'estimated_hours',
        'actual_hours',
        'dependencies'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'estimated_hours' => 'decimal:2',
        'actual_hours' => 'decimal:2',
        'dependencies' => 'json',
    ];
}
