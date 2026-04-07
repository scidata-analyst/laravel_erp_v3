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
        'role_name',
        'description',
        'permissions',
        'is_system_role',
        'is_active',
        'created_by'
    ];

    protected $casts = [
        'permissions' => 'json',
        'is_system_role' => 'boolean',
        'is_active' => 'boolean',
    ];

    /**
     * Get all users for the role.
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Get the user that created the role.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
