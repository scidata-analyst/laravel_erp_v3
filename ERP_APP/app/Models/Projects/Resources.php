<?php

namespace App\Models\Projects;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Resources extends Model
{
    use HasFactory;
    protected $fillable = [
        'employee',
        'role',
        'project',
        'allocation_percentage',
        'start_date',
        'end_date',
        'availability',
    ];
}
