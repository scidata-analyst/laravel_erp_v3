<?php

namespace App\DTOs\Documents;

use App\DTOs\UsersRoles\UserDTO;
use App\Models\Documents\DocVersions;

/**
 * Data Transfer Object for DocVersions entity.
 *
 * Used for type-safe data transfer between layers
 * and encapsulates document version history data.
 *
 * @property int|null $id
 * @property int|null $documentId
 * @property string|null $newVersion
 * @property string|null $changeType
 * @property string|null $changeSummary
 * @property int|null $changedByUserId
 * @property int|null $approverId
 * @property string|null $filePath
 * @property string|null $createdAt
 * @property string|null $updatedAt
 * @property DocLibraryDTO|null $document
 * @property UserDTO|null $changedByUser
 * @property UserDTO|null $approver
 */
class DocVersionsDTO
{
    /** @var int|null Unique identifier */
    public ?int $id;

    /** @var int|null Foreign key to document_library table */
    public ?int $documentId;

    /** @var string|null New version number (e.g., '1.1', '2.0') */
    public ?string $newVersion;

    /** @var string|null Type of change (e.g., 'Major', 'Minor', 'Revision') */
    public ?string $changeType;

    /** @var string|null Summary of changes */
    public ?string $changeSummary;

    /** @var int|null Foreign key to users table (who made changes) */
    public ?int $changedByUserId;

    /** @var int|null Foreign key to users table (approver) */
    public ?int $approverId;

    /** @var string|null File path for this version */
    public ?string $filePath;

    /** @var string|null Creation timestamp (ISO 8601) */
    public ?string $createdAt;

    /** @var string|null Last update timestamp (ISO 8601) */
    public ?string $updatedAt;

    /** @var DocLibraryDTO|null Related document */
    public ?DocLibraryDTO $document;

    /** @var UserDTO|null User who made the changes */
    public ?UserDTO $changedByUser;

    /** @var UserDTO|null User who approved this version */
    public ?UserDTO $approver;

    /**
     * Create a new DocVersionsDTO instance.
     *
     * @param array $data Optional data array for initialization
     */
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

    /**
     * Create DTO from Eloquent model instance.
     *
     * @param DocVersions $model Eloquent model to convert
     * @return self New DTO instance with model data
     */
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

    /**
     * Create DTO from plain array data.
     *
     * @param array $data Associative array with DTO properties
     * @return self New DTO instance
     */
    public static function fromArray(array $data): self
    {
        return new self($data);
    }

    /**
     * Convert DTO to array representation.
     *
     * @return array Array with snake_case keys matching database columns
     */
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

    /**
     * Convert DTO to array for Eloquent model creation/update.
     *
     * Returns fillable attributes only, excluding timestamps
     * and foreign keys for related models.
     *
     * @return array Associative array for model mass assignment
     */
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
