<?php

namespace App\Models\CRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Leads extends Model
{
    use HasFactory;
    protected $fillable = [
        'lead_name',
        'company_name',
        'email',
        'phone',
        'deal_value',
        'stage',
        'assigned_to',
        'notes',
    ];
}
