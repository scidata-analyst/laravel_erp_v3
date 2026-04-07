<?php

namespace App\Models\Documents;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DocVersions extends Model
{
    use HasFactory;
    protected $fillable = [
        'doc_library_id',
        'version_number',
        'file_path',
        'file_size',
        'changes_description',
        'created_by',
        'is_current',
        'approval_status',
        'approved_by',
        'approval_date'
    ];

    protected $casts = [
        'is_current' => 'boolean',
        'approval_date' => 'date',
    ];
}
