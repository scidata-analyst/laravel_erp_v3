<?php

namespace App\DTOs\CRM;

use App\DTOs\UsersRoles\UserDTO;
use App\Models\CRM\Leads;

class LeadsDTO
{
    public ?int $id;

    public ?string $leadName;

    public ?string $company;

    public ?string $email;

    public ?string $phone;

    public ?float $dealValue;

    public ?string $stage;

    public ?int $assignedUserId;

    public ?string $notes;

    public ?string $createdAt;

    public ?string $updatedAt;

    public ?UserDTO $assignedUser;

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

    public static function fromArray(array $data): self
    {
        return new self($data);
    }

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
