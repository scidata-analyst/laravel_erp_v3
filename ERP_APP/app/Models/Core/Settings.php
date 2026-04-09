<?php

namespace App\Models\Core;

use App\Models\Logistics\Warehouses;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Settings
 *
 * Laravel Eloquent model for Settings table.
 */
class Settings extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "settings";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_name',
        'company_email',
        'phone_number',
        'address',
        'country',
        'session_timeout_minutes',
        'two_factor_auth_enabled',
        'password_policy',
        'ip_whitelist',
        'email_notifications_enabled',
        'low_stock_threshold',
        'alert_recipients',
        'default_valuation_method',
        'auto_reorder_enabled',
        'default_warehouse_id',
        'status',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    public function default_warehouse()
    {
        return $this->belongsTo(Warehouses::class, 'default_warehouse_id');
    }
}
