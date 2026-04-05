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
        'customer',
        'subject',
        'low',
        'assigned_to',
        'category',
        'description',
        'priority',
        'status',
    ];
}
