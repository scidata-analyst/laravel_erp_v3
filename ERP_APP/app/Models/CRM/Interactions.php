<?php

namespace App\Models\CRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Interactions extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
        'customer',
        'contact',
        'type',
        'summary',
        'duration',
        'logged_by',
        'next_steps',
    ];
}
