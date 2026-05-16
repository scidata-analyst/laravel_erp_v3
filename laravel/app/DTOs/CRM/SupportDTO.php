<?php

namespace App\DTOs\CRM;

use App\DTOs\Sales\CustomersDTO;
use App\DTOs\UsersRoles\UserDTO;
use App\Models\CRM\Support;

/**
 * Data Transfer Object for Support entity.
 *
 * Used for type-safe data transfer between layers
 * and encapsulates customer support ticket data.
 *
 * @property int|null $id
 * @property string|null $ticketNumber
 * @property int|null $customerId
 * @property string|null $subject
 * @property string|null $description
 * @property string|null $priority
 * @property string|null $category
 * @property int|null $assignedUserId
 * @property int|null $status
 * @property string|null $createdAt
 * @property string|null $updatedAt
 * @property CustomersDTO|null $customer
 * @property UserDTO|null $assignedUser
 */
class SupportDTO
{
    /** @var int|null Unique identifier */
    public ?int $id;

    /** @var string|null Unique ticket number (e.g., 'TKT-2024-0001') */
    public ?string $ticketNumber;

    /** @var int|null Foreign key to customers table */
    public ?int $customerId;

    /** @var string|null Ticket subject/title */
    public ?string $subject;

    /** @var string|null Detailed description of the issue */
    public ?string $description;

    /** @var string|null Priority level (e.g., 'Low', 'Medium', 'High', 'Critical') */
    public ?string $priority;

    /** @var string|null Ticket category (e.g., 'Technical', 'Billing', 'General') */
    public ?string $category;

    /** @var int|null Foreign key to users table (assigned handler) */
    public ?int $assignedUserId;

    /** @var int|null Status: 0=Open, 1=InProgress, 2=Resolved, 3=Closed, 4=Cancelled */
    public ?int $status;

    /** @var string|null Creation timestamp (ISO 8601) */
    public ?string $createdAt;

    /** @var string|null Last update timestamp (ISO 8601) */
    public ?string $updatedAt;

    /** @var CustomersDTO|null Related customer */
    public ?CustomersDTO $customer;

    /** @var UserDTO|null Assigned user/handler */
    public ?UserDTO $assignedUser;

    /**
     * Create a new SupportDTO instance.
     *
     * @param array $data Optional data array for initialization
     */
    public function __construct(array $data = [])
    {
        $this->id = isset($data['id']) ? (int) $data['id'] : null;
        $this->ticketNumber = $data['ticket_number'] ?? null;
        $this->customerId = isset($data['customer_id']) ? (int) $data['customer_id'] : null;
        $this->subject = $data['subject'] ?? null;
        $this->description = $data['description'] ?? null;
        $this->priority = $data['priority'] ?? null;
        $this->category = $data['category'] ?? null;
        $this->assignedUserId = isset($data['assigned_user_id']) ? (int) $data['assigned_user_id'] : null;
        $this->status = isset($data['status']) ? (int) $data['status'] : null;
        $this->createdAt = $data['created_at'] ?? null;
        $this->updatedAt = $data['updated_at'] ?? null;
        $this->customer = $data['customer'] ?? null;
        $this->assignedUser = $data['assignedUser'] ?? null;
    }

    /**
     * Create DTO from Eloquent model instance.
     *
     * @param Support $model Eloquent model to convert
     * @return self New DTO instance with model data
     */
    public static function fromModel(Support $model): self
    {
        $data = [
            'id' => $model->id,
            'ticket_number' => $model->ticket_number,
            'customer_id' => $model->customer_id,
            'subject' => $model->subject,
            'description' => $model->description,
            'priority' => $model->priority,
            'category' => $model->category,
            'assigned_user_id' => $model->assigned_user_id,
            'status' => $model->status,
            'created_at' => $model->created_at?->toIso8601String(),
            'updated_at' => $model->updated_at?->toIso8601String(),
        ];

        if ($model->relationLoaded('customer')) {
            $data['customer'] = CustomersDTO::fromModel($model->customer);
        }

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
            'ticket_number' => $this->ticketNumber,
            'customer_id' => $this->customerId,
            'subject' => $this->subject,
            'description' => $this->description,
            'priority' => $this->priority,
            'category' => $this->category,
            'assigned_user_id' => $this->assignedUserId,
            'status' => $this->status,
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
            'ticket_number' => $this->ticketNumber,
            'customer_id' => $this->customerId,
            'subject' => $this->subject,
            'description' => $this->description,
            'priority' => $this->priority,
            'category' => $this->category,
            'assigned_user_id' => $this->assignedUserId,
            'status' => $this->status,
        ];
    }
}
