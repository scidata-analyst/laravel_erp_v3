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
        'document_id',
        'version_number',
        'file_path',
        'file_size',
        'changes_description',
        'changes',
        'change_type',
        'created_by',
        'is_current',
        'approval_status',
        'approved_by',
        'approval_date'
    ];

    protected $casts = [
        'file_size' => 'integer',
        'is_current' => 'boolean',
        'approval_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function document(): BelongsTo
    {
        return $this->belongsTo(DocLibrary::class, 'doc_library_id');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'created_by');
    }

    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'approved_by');
    }

    public function isApproved(): bool
    {
        return $this->approval_status === 'approved';
    }

    public function isPending(): bool
    {
        return $this->approval_status === 'pending';
    }

    public function isRejected(): bool
    {
        return $this->approval_status === 'rejected';
    }

    public function getFormattedFileSizeAttribute(): string
    {
        $bytes = $this->file_size;
        $units = ['B', 'KB', 'MB', 'GB'];

        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }

    public function getVersionLabelAttribute(): string
    {
        return 'v' . $this->version_number;
    }

    public function getDocumentIdAttribute()
    {
        return $this->doc_library_id;
    }

    public function setDocumentIdAttribute($value): void
    {
        $this->attributes['doc_library_id'] = $value;
    }

    public function getChangesAttribute(): ?string
    {
        return $this->changes_description;
    }

    public function setChangesAttribute(?string $value): void
    {
        $this->attributes['changes_description'] = $value;
    }
}
