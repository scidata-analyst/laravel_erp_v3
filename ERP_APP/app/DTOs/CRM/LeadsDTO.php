<?php

namespace App\DTOs\CRM;

use App\DTOs\UsersRoles\UserDTO;
use App\Models\CRM\Leads;

/**
 * Data Transfer Object for Leads entity.
 *
 * Used for type-safe data transfer between layers
 * and encapsulates sales lead/prospect data.
 *
 * @property int|null $id
 * @property string|null $leadName
 * @property string|null $company
 * @property string|null $email
 * @property string|null $phone
 * @property float|null $dealValue
 * @property string|null $stage
 * @property int|null $assignedUserId
 * @property string|null $notes
 * @property string|null $createdAt
 * @property string|null $updatedAt
 * @property UserDTO|null $assignedUser
 */
class LeadsDTO
{
    /** @var int|null Unique identifier */
    public ?int $id;

    /** @var string|null Name of the lead/prospect */
    public ?string $leadName;

    /** @var string|null Company name */
    public ?string $company;

    /** @var string|null Email address */
    public ?string $email;

    /** @var string|null Phone number */
    public ?string $phone;

    /** @var float|null Estimated deal value/amount */
    public ?float $dealValue;

    /** @var string|null Lead stage (e.g., 'New', 'Contacted', 'Qualified', 'Proposal', 'Won', 'Lost') */
    public ?string $stage;

    /** @var int|null Foreign key to users table (assigned sales person) */
    public ?int $assignedUserId;

    /** @var string|null Additional notes */
    public ?string $notes;

    /** @var string|null Creation timestamp (ISO 8601) */
    public ?string $createdAt;

    /** @var string|null Last update timestamp (ISO 8601) */
    public ?string $updatedAt;

    /** @var UserDTO|null Assigned user/salesperson */
    public ?UserDTO $assignedUser;

    /**
     * Create a new LeadsDTO instance.
     *
     * @param array $data Optional data array for initialization
     */
    public function __construct(array $data = [])
    {
        $this->id = isset($data['id']) ? (int) $data['id'] : null;
        $this->leadName = $data['lead_name'] ?? null;
        $this->company = $data['company'] ?? null;
        $this->email = $data['email'] ?? null;
        $this->phone = $data['phone'] ?? null;
        $this->dealValue = isset($data['deal_value']) ? (float) $data['deal_value'] : null;
        $this->stage = $data['stage'] ?? null;
        $this->assignedUserId = isset($data['assigned_user_id']) ? (int) $data['assigned_user_id'] : null;
        $this->notes = $data['notes'] ?? null;
        $this->createdAt = $data['created_at'] ?? null;
        $this->updatedAt = $data['updated_at'] ?? null;
        $this->assignedUser = $data['assignedUser'] ?? null;
    }

    /**
     * Create DTO from Eloquent model instance.
     *
     * @param Leads $model Eloquent model to convert
     * @return self New DTO instance with model data
     */
    public static function fromModel(Leads $model): self
    {
        $data = [
            'id' => $model->id,
            'lead_name' => $model->lead_name,
            'company' => $model->company,
            'email' => $model->email,
            'phone' => $model->phone,
            'deal_value' => $model->deal_value,
            'stage' => $model->stage,
            'assigned_user_id' => $model->assigned_user_id,
            'notes' => $model->notes,
            'created_at' => $model->created_at?->toIso8601String(),
            'updated_at' => $model->updated_at?->toIso8601String(),
        ];

        if ($model->relationLoaded('assignedUser')) {
            $data['assignedUser'] = UserDTO::fromModel($model->assignedUser);
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
            'lead_name' => $this->leadName,
            'company' => $this->company,
            'email' => $this->email,
            'phone' => $this->phone,
            'deal_value' => $this->dealValue,
            'stage' => $this->stage,
            'assigned_user_id' => $this->assignedUserId,
            'notes' => $this->notes,
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
            'lead_name' => $this->leadName,
            'company' => $this->company,
            'email' => $this->email,
            'phone' => $this->phone,
            'deal_value' => $this->dealValue,
            'stage' => $this->stage,
            'assigned_user_id' => $this->assignedUserId,
            'notes' => $this->notes,
        ];
    }
}
