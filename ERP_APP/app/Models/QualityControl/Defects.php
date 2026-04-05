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
        'reported_by',
        'status',
        'qtuantity_defective',
        'description',
    ];
}
