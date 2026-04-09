<?php

namespace App\Models\Ecommerce;

use App\Models\Logistics\Warehouses;
use App\Models\UsersRoles\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Pos
 *
 * Laravel Eloquent model for Pos table.
 */
class Pos extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pos_terminals';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'terminal_id',
        'location',
        'assigned_cashier_id',
        'warehouse_id',
        'receipt_printer',
        'status',
    ];

    public function assigned_cashier(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_cashier_id');
    }

    public function warehouse(): BelongsTo
    {
        return $this->belongsTo(Warehouses::class, 'warehouse_id');
    }

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;
}
