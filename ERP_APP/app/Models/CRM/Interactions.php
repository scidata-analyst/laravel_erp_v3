<?php

namespace App\Models\CRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Interactions extends Model
{
    use HasFactory;
    protected $fillable = [
        'interaction_type',
        'lead_id',
        'customer_id',
        'sales_order_id',
        'support_ticket_id',
        'interaction_date',
        'subject',
        'description',
        'next_action',
        'next_action_date',
        'assigned_to',
        'status',
        'created_by'
    ];

    protected $casts = [
        'interaction_date' => 'datetime',
        'next_action_date' => 'datetime',
    ];
}
