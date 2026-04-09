<?php

namespace App\Models\Ecommerce;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class InvSync
 *
 * Laravel Eloquent model for InvSync table.
 */
class InvSync extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'inventory_sync';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'channel_id',
        'last_sync_time',
        'total_synced_items',
        'sync_errors',
        'status',
    ];

    public function channel(): \Illuminate\Database\Eloquent\Relations\BelongsTo {
        return $this->belongsTo(\App\Models\Ecommerce\OnlineChannels::class, 'channel_id');
    }

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;
}
