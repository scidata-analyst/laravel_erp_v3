<?php

namespace App\DTOs\Documents;

use App\DTOs\UsersRoles\UserDTO;
use App\Models\Documents\DocLibrary;

class DocLibraryDTO
{
    public ?int $id;

    public ?string $documentName;

    public ?string $documentType;

    public ?string $relatedTo;

    public ?string $version;

    public ?string $accessLevel;

    public ?string $filePath;

    public ?string $notes;

    public ?int $uploadedByUserId;

    public ?string $createdAt;

    public ?string $updatedAt;

    public ?UserDTO $uploadedByUser;

    public function __construct(array $data = [])
    {
        $this->id = isset($data['id']) ? (int) $data['id'] : null;
        $this->documentName = $data['document_name'] ?? null;
        $this->documentType = $data['document_type'] ?? null;
        $this->relatedTo = $data['related_to'] ?? null;
        $this->version = $data['version'] ?? null;
        $this->accessLevel = $data['access_level'] ?? null;
        $this->filePath = $data['file_path'] ?? null;
        $this->notes = $data['notes'] ?? null;
        $this->uploadedByUserId = isset($data['uploaded_by_user_id']) ? (int) $data['uploaded_by_user_id'] : null;
        $this->createdAt = $data['created_at'] ?? null;
        $this->updatedAt = $data['updated_at'] ?? null;
        $this->uploadedByUser = $data['uploadedByUser'] ?? null;
    }

    public static function fromModel(DocLibrary $model): self
    {
        $data = [
            'id' => $model->id,
            'document_name' => $model->document_name,
            'document_type' => $model->document_type,
            'related_to' => $model->related_to,
            'version' => $model->version,
            'access_level' => $model->access_level,
            'file_path' => $model->file_path,
            'notes' => $model->notes,
            'uploaded_by_user_id' => $model->uploaded_by_user_id,
            'created_at' => $model->created_at?->toIso8601String(),
            'updated_at' => $model->updated_at?->toIso8601String(),
        ];

        if ($model->relationLoaded('uploadedByUser')) {
            $data['uploadedByUser'] = UserDTO::fromModel($model->uploadedByUser);
        }

        return new self($data);
    }

    public static function fromArray(array $data): self
    {
        return new self($data);
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'document_name' => $this->documentName,
            'document_type' => $this->documentType,
            'related_to' => $this->relatedTo,
            'version' => $this->version,
            'access_level' => $this->accessLevel,
            'file_path' => $this->filePath,
            'notes' => $this->notes,
            'uploaded_by_user_id' => $this->uploadedByUserId,
            'created_at' => $this->createdAt,
            'updated_at' => $this->updatedAt,
        ];
    }

    public function toModel(): array
    {
        return [
            'document_name' => $this->documentName,
            'document_type' => $this->documentType,
            'related_to' => $this->relatedTo,
            'version' => $this->version,
            'access_level' => $this->accessLevel,
            'file_path' => $this->filePath,
            'notes' => $this->notes,
            'uploaded_by_user_id' => $this->uploadedByUserId,
        ];
    }
}
