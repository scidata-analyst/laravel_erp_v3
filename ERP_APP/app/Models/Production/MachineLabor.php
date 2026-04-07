<?php

namespace App\Models\Production;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MachineLabor extends Model
{
    use HasFactory;
    protected $fillable = [
        'work_order_id',
        'machine_id',
        'operator_id',
        'start_time',
        'end_time',
        'output_quantity',
        'scrap_quantity',
        'status',
        'notes'
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];
}
