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
        'changed_by',
        'change_summary',
        'date',
        'approved_by',
        'status',
    ];
}
