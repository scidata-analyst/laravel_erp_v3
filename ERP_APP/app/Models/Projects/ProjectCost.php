<?php

namespace App\Models\Projects;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProjectCost extends Model
{
    use HasFactory;
    protected $fillable = [
        'project_id',
        'cost_category',
        'description',
        'budgeted_amount',
        'actual_amount',
        'variance',
        'currency',
        'cost_date',
        'approved_by',
        'status'
    ];

    protected $casts = [
        'budgeted_amount' => 'decimal:2',
        'actual_amount' => 'decimal:2',
        'variance' => 'decimal:2',
        'cost_date' => 'date',
    ];
}
