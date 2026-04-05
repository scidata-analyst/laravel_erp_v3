<?php

namespace App\Models\QualityControl;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QcChecklists extends Model
{
    use HasFactory;
    protected $fillable = [
        'checklist_number',
        'product_id',
        'inspector_id',
        'inspection_type',
        'inspection_date',
        'sample_size',
        'items_checked',
        'items_passed',
        'pass_rate',
        'status',
        'checklist_items',
    ];
}
