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
        'module',
        'fields',
        'schedule',
        'last_run',
        'format',
        'status',
        'filters',
    ];
}
