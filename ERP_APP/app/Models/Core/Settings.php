<?php

namespace App\Models\Core;

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
        'base_currency',
        'fiscal_year_start',
        'company_address',
        'session_timeout',
        'two_factor_auth',
        'password_policy',
        'ip_whitelist',
        'default_valuation',
        'auto_reorder',
        'default_warehouse',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;
}
