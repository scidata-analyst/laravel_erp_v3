<?php

namespace App\Models\Documents;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DocVersions
 *
 * Laravel Eloquent model for DocVersions table.
 */
class DocVersions extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'document_versions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'document_id',
        'new_version',
        'change_type',
        'change_summary',
        'changed_by_user_id',
        'approver_id',
        'file_path',
    ];

    public function document(): \Illuminate\Database\Eloquent\Relations\BelongsTo {
        return $this->belongsTo(\App\Models\Documents\DocLibrary::class, 'document_id');
    }

    public function changedByUser(): \Illuminate\Database\Eloquent\Relations\BelongsTo {
        return $this->belongsTo(\App\Models\UsersRoles\User::class, 'changed_by_user_id');
    }

    public function approver(): \Illuminate\Database\Eloquent\Relations\BelongsTo {
        return $this->belongsTo(\App\Models\UsersRoles\User::class, 'approver_id');
    }

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;
}
