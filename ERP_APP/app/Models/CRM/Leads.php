<?php

namespace App\Models\CRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Leads
 *
 * Laravel Eloquent model for Leads table.
 */
class Leads extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'leads';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'lead_name',
        'company',
        'email',
        'phone',
        'deal_value',
        'stage',
        'assigned_user_id',
        'notes',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Get the assigned user for this lead.
     */
    public function assignedUser(): BelongsTo
    {
        return $this->belongsTo(\App\Models\UsersRoles\User::class, 'assigned_user_id');
    }
}
