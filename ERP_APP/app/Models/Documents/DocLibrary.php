<?php

namespace App\Models\Documents;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DocLibrary
 *
 * Laravel Eloquent model for DocLibrary table.
 */
class DocLibrary extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'document_library';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'document_name',
        'document_type',
        'related_to',
        'version',
        'access_level',
        'file_path',
        'notes',
        'uploaded_by_user_id',
    ];

    public function uploadedByUser(): \Illuminate\Database\Eloquent\Relations\BelongsTo {
        return $this->belongsTo(\App\Models\UsersRoles\User::class, 'uploaded_by_user_id');
    }

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;
}
