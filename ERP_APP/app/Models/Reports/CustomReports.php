<?php

namespace App\Models\Reports;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CustomReports extends Model
{
    use HasFactory;
    protected $fillable = [
        'report_name',
        'report_type',
        'description',
        'query_sql',
        'parameters',
        'schedule',
        'recipients',
        'format_type',
        'created_by',
        'last_run_date',
        'status'
    ];

    protected $casts = [
        'parameters' => 'json',
        'recipients' => 'json',
        'last_run_date' => 'datetime',
    ];
}
