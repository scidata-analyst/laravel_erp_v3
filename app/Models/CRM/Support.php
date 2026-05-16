<?php

namespace App\Models\CRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Support
 *
 * Laravel Eloquent model for Support table.
 */
class Support extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'support_tickets';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ticket_number',
        'customer_id',
        'subject',
        'description',
        'priority',
        'category',
        'assigned_user_id',
        'status',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Get the customer associated with this support ticket.
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Sales\Customers::class, 'customer_id');
    }

    /**
     * Get the assigned user for this support ticket.
     */
    public function assignedUser(): BelongsTo
    {
        return $this->belongsTo(\App\Models\UsersRoles\User::class, 'assigned_user_id');
    }
}
