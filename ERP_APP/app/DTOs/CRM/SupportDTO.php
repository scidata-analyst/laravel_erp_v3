<?php

namespace App\DTOs\CRM;

use App\DTOs\Sales\CustomersDTO;
use App\DTOs\UsersRoles\UserDTO;
use App\Models\CRM\Support;

class SupportDTO
{
    public ?int $id;

    public ?string $ticketNumber;

    public ?int $customerId;

    public ?string $subject;

    public ?string $description;

    public ?string $priority;

    public ?string $category;

    public ?int $assignedUserId;

    public ?int $status;

    public ?string $createdAt;

    public ?string $updatedAt;

    public ?CustomersDTO $customer;

    public ?UserDTO $assignedUser;

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

    public static function fromArray(array $data): self
    {
        return new self($data);
    }

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
