<?php

namespace App\DTOs\CRM;

use App\DTOs\Sales\CustomersDTO;
use App\Models\CRM\Interactions;

/**
 * Data Transfer Object for Interactions entity.
 *
 * Used for type-safe data transfer between layers
 * and encapsulates customer interaction/history data.
 *
 * @property int|null $id
 * @property int|null $customerId
 * @property string|null $contactPerson
 * @property string|null $interactionType
 * @property string|null $interactionDate
 * @property string|null $duration
 * @property string|null $summary
 * @property string|null $nextAction
 * @property string|null $createdAt
 * @property string|null $updatedAt
 * @property CustomersDTO|null $customer
 */
class InteractionsDTO
{
    /** @var int|null Unique identifier */
    public ?int $id;

    /** @var int|null Foreign key to customers table */
    public ?int $customerId;

    /** @var string|null Contact person name */
    public ?string $contactPerson;

    /** @var string|null Type of interaction (e.g., 'Call', 'Email', 'Meeting', 'Chat') */
    public ?string $interactionType;

    /** @var string|null Date of interaction (Y-m-d) */
    public ?string $interactionDate;

    /** @var string|null Duration (e.g., '30 minutes', '1 hour') */
    public ?string $duration;

    /** @var string|null Summary of interaction */
    public ?string $summary;

    /** @var string|null Next action to take */
    public ?string $nextAction;

    /** @var string|null Creation timestamp (ISO 8601) */
    public ?string $createdAt;

    /** @var string|null Last update timestamp (ISO 8601) */
    public ?string $updatedAt;

    /** @var CustomersDTO|null Related customer */
    public ?CustomersDTO $customer;

    /**
     * Create a new InteractionsDTO instance.
     *
     * @param array $data Optional data array for initialization
     */
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

    /**
     * Create DTO from Eloquent model instance.
     *
     * @param Interactions $model Eloquent model to convert
     * @return self New DTO instance with model data
     */
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
