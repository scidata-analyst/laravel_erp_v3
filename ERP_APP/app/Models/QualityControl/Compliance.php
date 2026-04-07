<?php

namespace App\Models\QualityControl;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Compliance extends Model
{
    use HasFactory;
    protected $fillable = [
        'report_number',
        'compliance_type',
        'standard_reference',
        'audit_date',
        'auditor_id',
        'findings',
        'risk_level',
        'corrective_actions',
        'due_date',
        'completion_date',
        'status',
        'notes',
        'attachments'
    ];

    protected $casts = [
        'audit_date' => 'date',
        'due_date' => 'date',
        'completion_date' => 'date',
        'findings' => 'json',
        'corrective_actions' => 'json',
        'attachments' => 'json',
    ];
}
