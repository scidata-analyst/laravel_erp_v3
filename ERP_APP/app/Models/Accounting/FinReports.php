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
        'description',
        'report_data',
        'start_date',
        'end_date',
        'status',
        'created_by'
    ];

    protected $casts = [
        'report_data' => 'json',
        'start_date' => 'date',
        'end_date' => 'date',
    ];
}
