<?php

namespace App\DTOs\CRM;

use App\DTOs\Sales\CustomersDTO;
use App\Models\CRM\Interactions;

class InteractionsDTO
{
    public ?int $id;

    public ?int $customerId;

    public ?string $contactPerson;

    public ?string $interactionType;

    public ?string $interactionDate;

    public ?string $duration;

    public ?string $summary;

    public ?string $nextAction;

    public ?string $createdAt;

    public ?string $updatedAt;

    public ?CustomersDTO $customer;

    public function __construct(array $data = [])
    {
        $this->id = isset($data['id']) ? (int) $data['id'] : null;
        $this->customerId = isset($data['customer_id']) ? (int) $data['customer_id'] : null;
        $this->contactPerson = $data['contact_person'] ?? null;
        $this->interactionType = $data['interaction_type'] ?? null;
        $this->interactionDate = $data['interaction_date'] ?? null;
        $this->duration = $data['duration'] ?? null;
        $this->summary = $data['summary'] ?? null;
        $this->nextAction = $data['next_action'] ?? null;
        $this->createdAt = $data['created_at'] ?? null;
        $this->updatedAt = $data['updated_at'] ?? null;
        $this->customer = $data['customer'] ?? null;
    }

    public static function fromModel(Interactions $model): self
    {
        $data = [
            'id' => $model->id,
            'customer_id' => $model->customer_id,
            'contact_person' => $model->contact_person,
            'interaction_type' => $model->interaction_type,
            'interaction_date' => $model->interaction_date,
            'duration' => $model->duration,
            'summary' => $model->summary,
            'next_action' => $model->next_action,
            'created_at' => $model->created_at?->toIso8601String(),
            'updated_at' => $model->updated_at?->toIso8601String(),
        ];

        if ($model->relationLoaded('customer')) {
            $data['customer'] = CustomersDTO::fromModel($model->customer);
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
            'customer_id' => $this->customerId,
            'contact_person' => $this->contactPerson,
            'interaction_type' => $this->interactionType,
            'interaction_date' => $this->interactionDate,
            'duration' => $this->duration,
            'summary' => $this->summary,
            'next_action' => $this->nextAction,
            'created_at' => $this->createdAt,
            'updated_at' => $this->updatedAt,
        ];
    }

    public function toModel(): array
    {
        return [
            'customer_id' => $this->customerId,
            'contact_person' => $this->contactPerson,
            'interaction_type' => $this->interactionType,
            'interaction_date' => $this->interactionDate,
            'duration' => $this->duration,
            'summary' => $this->summary,
            'next_action' => $this->nextAction,
        ];
    }
}
