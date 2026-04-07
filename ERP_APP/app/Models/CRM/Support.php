<?php

namespace App\Models\CRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Support extends Model
{
    use HasFactory;
    protected $fillable = [
        'ticket_number',
        'customer_id',
        'lead_id',
        'subject',
        'description',
        'priority',
        'category',
        'assigned_to',
        'status',
        'resolution',
        'resolution_date',
        'customer_satisfaction',
        'response_time_hours',
        'created_date',
        'last_response_date'
    ];

    protected $casts = [
        'resolution_date' => 'datetime',
        'response_time_hours' => 'decimal:2',
        'created_date' => 'datetime',
        'last_response_date' => 'datetime',
    ];
}
