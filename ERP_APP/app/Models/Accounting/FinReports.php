<?php

namespace App\Models\Accounting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FinReports extends Model
{
    use HasFactory;
    protected $fillable = [
        'report_name',
        'report_type',
        'period',
        'generated_at',
        'generated_by',
        'format',
    ];
}
