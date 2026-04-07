<?php

namespace App\Models\QualityControl;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Defects extends Model
{
    use HasFactory;
    protected $fillable = [
        'defect_number',
        'product_id',
        'batch_number',
        'defect_type',
        'severity',
        'description',
        'detected_by',
        'detection_date',
        'status',
        'resolution',
        'resolution_date',
        'cost_impact',
        'affected_quantity',
        'compliance_id'
    ];

    protected $casts = [
        'detection_date' => 'date',
        'resolution_date' => 'date',
        'cost_impact' => 'decimal:2',
    ];
}
