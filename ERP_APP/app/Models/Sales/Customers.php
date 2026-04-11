<?php

namespace App\Models\Sales;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Customers
 *
 * Laravel Eloquent model for Customers table.
 */
class Customers extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'customers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_name',
        'contact_person',
        'email',
        'phone',
        'credit_limit',
        'sales_rep_id',
        'billing_address',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Get the sales representative for this customer.
     */
    public function salesRep(): BelongsTo
    {
        return $this->belongsTo(\App\Models\UsersRoles\User::class, 'sales_rep_id');
    }

    /**
     * Get the invoices for this customer.
     */
    public function invoices(): HasMany
    {
        return $this->hasMany(Invoices::class, 'customer_id');
    }

    /**
     * Get the sales orders for this customer.
     */
    public function salesOrders(): HasMany
    {
        return $this->hasMany(SalesOrders::class, 'customer_id');
    }
}
