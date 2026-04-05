<?php

namespace App\Models\Production;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MachineLabor extends Model
{
    use HasFactory;
    protected $fillable = [
        'work_order',
        'resource',
        'type',
        'schedule_hour',
        'actual_hour',
        'cost',
        'total_cost',
    ];
}
