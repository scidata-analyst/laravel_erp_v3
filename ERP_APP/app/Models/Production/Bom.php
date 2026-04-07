<?php

namespace App\Models\Production;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Bom extends Model
{
    use HasFactory;
    protected $fillable = [
        'bom_number',
        'finished_product',
        'version',
        'lead_time_days',
        'estimated_cost',
        'status',
        'components',
        'notes'
    ];

    protected $casts = [
        'estimated_cost' => 'decimal:2',
        'components' => 'json',
    ];
}
