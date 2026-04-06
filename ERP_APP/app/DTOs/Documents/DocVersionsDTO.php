<?php

namespace App\DTOs\Documents;

final class DocLibraryDTO
{
    public readonly string $title;
    public readonly string $fileType;
    public readonly string $filePath;
    public readonly int $fileSize;
    public readonly ?string $category;
    public readonly ?string $version;
    public readonly ?int $uploadedBy;
    public readonly ?string $status;
    public readonly ?string $description;

    public function __construct(array $data)
    {
        $this->title = (string)($data['title'] ?? $data['name'] ?? $data['file_name'] ?? '');
        $this->fileType = (string)($data['file_type'] ?? '');
        $this->filePath = (string)($data['file_path'] ?? '');
        $this->fileSize = isset($data['file_size']) ? (int)$data['file_size'] : 0;
        $this->category = $data['category'] ?? null;
        $this->version = $data['version'] ?? null;
        $this->uploadedBy = isset($data['uploaded_by']) ? (int)$data['uploaded_by'] : null;
        $this->status = $data['status'] ?? 'Active';
        $this->description = $data['description'] ?? $data['notes'] ?? null;
    }
}