<?php

namespace App\DTOs\Documents;

class DocLibraryDTO
{
    public function __construct(
        public readonly string $title,
        public readonly string $file_type,
        public readonly string $file_path,
        public readonly int $file_size,
        public readonly ?string $category = null,
        public readonly ?string $version = null,
        public readonly ?int $uploaded_by = null,
        public readonly ?string $status = 'Active',
        public readonly ?string $description = null,
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            title: $data['title'] ?? $data['name'] ?? $data['file_name'],
            file_type: $data['file_type'],
            file_path: $data['file_path'],
            file_size: (int) $data['file_size'],
            category: $data['category'] ?? null,
            version: $data['version'] ?? null,
            uploaded_by: isset($data['uploaded_by']) ? (int) $data['uploaded_by'] : null,
            status: $data['status'] ?? 'Active',
            description: $data['description'] ?? $data['notes'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'file_type' => $this->file_type,
            'file_path' => $this->file_path,
            'file_size' => $this->file_size,
            'category' => $this->category,
            'version' => $this->version,
            'uploaded_by' => $this->uploaded_by,
            'status' => $this->status,
            'description' => $this->description,
        ];
    }
}
