<?php

namespace App\Models\UsersRoles;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Roles extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'permissions',
        'is_active',
        'created_by'
    ];
}
