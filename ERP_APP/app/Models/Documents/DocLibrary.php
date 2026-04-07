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
        'title',
        'description',
        'category',
        'file_path',
        'file_size',
        'file_type',
        'version',
        'uploaded_by',
        'department',
        'status',
        'tags',
        'expiry_date'
    ];

    protected $casts = [
        'tags' => 'json',
        'expiry_date' => 'date',
    ];
}
