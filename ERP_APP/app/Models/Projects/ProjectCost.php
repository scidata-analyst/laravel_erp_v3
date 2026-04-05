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
        'project',
        'budget',
        'spent',
        'remaining',
        'used',
        'variance',
        'status',
        'cost_category',
        'date_incurred',
        'approved_by',
        'notes'
    ];
}
