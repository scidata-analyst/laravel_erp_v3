<?php

namespace App\Models\Documents;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;

class DocLibrary extends Model
{
    use HasFactory;
    protected $fillable = [
        'doc_name',
        'doc_type',
        'related_to',
        'version',
        'file_size',
        'uploaded_by',
        'date',
        'access_level',
        'notes',
    ];
}
