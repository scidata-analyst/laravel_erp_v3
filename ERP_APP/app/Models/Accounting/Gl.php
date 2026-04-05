<?php

namespace App\Models\Accounting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Gl extends Model
{
    use HasFactory;
    protected $fillable = [
        'account_code',
        'account_name',
        'account_type',
        'debit',
        'credit',
        'balance',
        'asset_type',
        'narration',
    ];
}
