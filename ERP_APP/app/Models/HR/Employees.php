<?php

namespace App\Models\HR;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employees extends Model
{
    use HasFactory;

    protected $fillable = [
        'emp_id',
        'name',
        'position',
        'department',
        'phone',
        'joining_date',
        'salary',
        'status',
        'contract_type',
        'email'
    ];
}
