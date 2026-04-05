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
        'product',
        'version',
        'component',
        'estimated_cost',
        'lead_time',
        'status',
    ];
}
