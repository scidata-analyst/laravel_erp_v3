<?php

namespace App\DTOs\Documents;

class DocVersionsDTO
{
    public function __construct(
        public readonly int $doc_library_id,
        public readonly string $version_number,
        public readonly ?string $change_type = null,
        public readonly string $file_path,
        public readonly int $file_size,
        public readonly ?string $changes_description = null,
        public readonly ?int $created_by = null,
        public readonly ?int $approved_by = null,
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            doc_library_id: (int) ($data['doc_library_id'] ?? $data['document_id']),
            version_number: $data['version_number'],
            change_type: $data['change_type'] ?? null,
            file_path: $data['file_path'],
            file_size: (int) ($data['file_size'] ?? 0),
            changes_description: $data['changes_description'] ?? $data['changes'] ?? $data['change_log'] ?? null,
            created_by: isset($data['created_by']) ? (int) $data['created_by'] : (isset($data['uploaded_by']) ? (int) $data['uploaded_by'] : null),
            approved_by: isset($data['approved_by']) ? (int) $data['approved_by'] : null,
        );
    }

    public function toArray(): array
    {
        return [
            'doc_library_id' => $this->doc_library_id,
            'version_number' => $this->version_number,
            'change_type' => $this->change_type,
            'file_path' => $this->file_path,
            'file_size' => $this->file_size,
            'changes_description' => $this->changes_description,
            'created_by' => $this->created_by,
            'approved_by' => $this->approved_by,
        ];
    }
}
