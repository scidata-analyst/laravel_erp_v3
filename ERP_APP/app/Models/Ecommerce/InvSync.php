<?php

namespace App\Models\Ecommerce;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class InvSync extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'product_sku',
        'erp_sync',
        'shopify_sync',
        'dara_sync',
        'daraz_sync',
        'pos_sync',
        'last_synced_at',
        'sync_status',
    ];
}
