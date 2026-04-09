<?php

namespace App\DTOs\Documents;

use App\DTOs\UsersRoles\UserDTO;
use App\Models\Documents\DocVersions;

class DocVersionsDTO
{
    public ?int $id;

    public ?int $documentId;

    public ?string $newVersion;

    public ?string $changeType;

    public ?string $changeSummary;

    public ?int $changedByUserId;

    public ?int $approverId;

    public ?string $filePath;

    public ?string $createdAt;

    public ?string $updatedAt;

    public ?DocLibraryDTO $document;

    public ?UserDTO $changedByUser;

    public ?UserDTO $approver;

    public function __construct(array $data = [])
    {
        $this->id = isset($data['id']) ? (int) $data['id'] : null;
        $this->documentId = isset($data['document_id']) ? (int) $data['document_id'] : null;
        $this->newVersion = $data['new_version'] ?? null;
        $this->changeType = $data['change_type'] ?? null;
        $this->changeSummary = $data['change_summary'] ?? null;
        $this->changedByUserId = isset($data['changed_by_user_id']) ? (int) $data['changed_by_user_id'] : null;
        $this->approverId = isset($data['approver_id']) ? (int) $data['approver_id'] : null;
        $this->filePath = $data['file_path'] ?? null;
        $this->createdAt = $data['created_at'] ?? null;
        $this->updatedAt = $data['updated_at'] ?? null;
        $this->document = $data['document'] ?? null;
        $this->changedByUser = $data['changedByUser'] ?? null;
        $this->approver = $data['approver'] ?? null;
    }

    public static function fromModel(DocVersions $model): self
    {
        $data = [
            'id' => $model->id,
            'document_id' => $model->document_id,
            'new_version' => $model->new_version,
            'change_type' => $model->change_type,
            'change_summary' => $model->change_summary,
            'changed_by_user_id' => $model->changed_by_user_id,
            'approver_id' => $model->approver_id,
            'file_path' => $model->file_path,
            'created_at' => $model->created_at?->toIso8601String(),
            'updated_at' => $model->updated_at?->toIso8601String(),
        ];

        if ($model->relationLoaded('document')) {
            $data['document'] = DocLibraryDTO::fromModel($model->document);
        }

        if ($model->relationLoaded('changedByUser')) {
            $data['changedByUser'] = UserDTO::fromModel($model->changedByUser);
        }

        if ($model->relationLoaded('approver')) {
            $data['approver'] = UserDTO::fromModel($model->approver);
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
            'document_id' => $this->documentId,
            'new_version' => $this->newVersion,
            'change_type' => $this->changeType,
            'change_summary' => $this->changeSummary,
            'changed_by_user_id' => $this->changedByUserId,
            'approver_id' => $this->approverId,
            'file_path' => $this->filePath,
            'created_at' => $this->createdAt,
            'updated_at' => $this->updatedAt,
        ];
    }

    public function toModel(): array
    {
        return [
            'document_id' => $this->documentId,
            'new_version' => $this->newVersion,
            'change_type' => $this->changeType,
            'change_summary' => $this->changeSummary,
            'changed_by_user_id' => $this->changedByUserId,
            'approver_id' => $this->approverId,
            'file_path' => $this->filePath,
        ];
    }
}
