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
        'name',
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
        'notes',
        'expiry_date'
    ];

    protected $casts = [
        'file_size' => 'integer',
        'expiry_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function uploadedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    public function versions(): HasMany
    {
        return $this->hasMany(DocVersions::class, 'doc_library_id');
    }

    public function getNameAttribute(): string
    {
        return (string) $this->title;
    }

    public function setNameAttribute(?string $value): void
    {
        $this->attributes['title'] = $value;
    }

    public function getNotesAttribute(): ?string
    {
        return $this->description;
    }

    public function setNotesAttribute(?string $value): void
    {
        $this->attributes['description'] = $value;
    }
}
