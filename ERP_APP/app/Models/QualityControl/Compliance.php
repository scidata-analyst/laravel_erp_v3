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
        'standard_name',
        'scope',
        'audit_date',
        'next_audit_date',
        'auditor_id',
        'findings',
        'status',
        'notes',
    ];
}
