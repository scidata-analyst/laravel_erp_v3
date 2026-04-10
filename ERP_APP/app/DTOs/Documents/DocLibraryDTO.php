<?php

namespace App\DTOs\Documents;

use App\DTOs\UsersRoles\UserDTO;
use App\Models\Documents\DocLibrary;

/**
 * Data Transfer Object for DocLibrary entity.
 *
 * Used for type-safe data transfer between layers
 * and encapsulates document/library data.
 *
 * @property int|null $id
 * @property string|null $documentName
 * @property string|null $documentType
 * @property string|null $relatedTo
 * @property string|null $version
 * @property string|null $accessLevel
 * @property string|null $filePath
 * @property string|null $notes
 * @property int|null $uploadedByUserId
 * @property string|null $createdAt
 * @property string|null $updatedAt
 * @property UserDTO|null $uploadedByUser
 */
class DocLibraryDTO
{
    /** @var int|null Unique identifier */
    public ?int $id;

    /** @var string|null Document name/title */
    public ?string $documentName;

    /** @var string|null Document type (e.g., 'PDF', 'Word', 'Excel', 'Image') */
    public ?string $documentType;

    /** @var string|null Related entity (e.g., 'Sales', 'Purchase', 'HR') */
    public ?string $relatedTo;

    /** @var string|null Document version (e.g., '1.0', '2.1') */
    public ?string $version;

    /** @var string|null Access level (e.g., 'Public', 'Private', 'Restricted') */
    public ?string $accessLevel;

    /** @var string|null File path on storage */
    public ?string $filePath;

    /** @var string|null Additional notes/description */
    public ?string $notes;

    /** @var int|null Foreign key to users table (uploader) */
    public ?int $uploadedByUserId;

    /** @var string|null Creation timestamp (ISO 8601) */
    public ?string $createdAt;

    /** @var string|null Last update timestamp (ISO 8601) */
    public ?string $updatedAt;

    /** @var UserDTO|null User who uploaded the document */
    public ?UserDTO $uploadedByUser;

    /**
     * Create a new DocLibraryDTO instance.
     *
     * @param array $data Optional data array for initialization
     */
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

    /**
     * Create DTO from Eloquent model instance.
     *
     * @param DocLibrary $model Eloquent model to convert
     * @return self New DTO instance with model data
     */
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
