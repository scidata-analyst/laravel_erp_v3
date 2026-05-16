<?php

namespace App\DTOs\Accounting;

use App\Models\Accounting\ApAr;

/**
 * Data Transfer Object for Accounts Payable/Receivable.
 * Used for type-safe transfer of AP/AR transaction data.
 */
class ApArDTO
{
    /**
     * Unique identifier of the AP/AR transaction.
     *
     * @var int|null
     */
    public ?int $id;

    /**
     * Name of the party (customer or vendor).
     *
     * @var string|null
     */
    public ?string $partyName;

    /**
     * Type of transaction (AP = Accounts Payable, AR = Accounts Receivable).
     *
     * @var string|null
     */
    public ?string $apArType;

    /**
     * Amount due.
     *
     * @var float|null
     */
    public ?float $amount;

    /**
     * Due date for payment.
     *
     * @var string|null
     */
    public ?string $dueDate;

    /**
     * Reference number or invoice number.
     *
     * @var string|null
     */
    public ?string $reference;

    /**
     * Status of the transaction (0 = unpaid, 1 = paid, 2 = overdue, 3 = partial).
     *
     * @var int|null
     */
    public ?int $status;

    /**
     * timestamp when the transaction was created.
     *
     * @var string|null
     */
    public ?string $createdAt;

    /**
     * Timestamp when the transaction was last updated.
     *
     * @var string|null
     */
    public ?string $updatedAt;

    /**
     * Create a new ApArDTO instance.
     *
     * @param array $data Data array with keys matching DTO properties
     */
    public function __construct(array $data = [])
    {
        $this->id = isset($data['id']) ? (int) $data['id'] : null;
        $this->partyName = $data['party_name'] ?? null;
        $this->apArType = $data['ap_ar_type'] ?? null;
        $this->amount = isset($data['amount']) ? (float) $data['amount'] : null;
        $this->dueDate = $data['due_date'] ?? null;
        $this->reference = $data['reference'] ?? null;
        $this->status = isset($data['status']) ? (int) $data['status'] : null;
        $this->createdAt = $data['created_at'] ?? null;
        $this->updatedAt = $data['updated_at'] ?? null;
    }

    /**
     * Create a DTO instance from an ApAr model.
     *
     * @param ApAr $model The ApAr model instance
     * @return self New DTO instance populated from the model
     */
    public static function fromModel(ApAr $model): self
    {
        return new self([
            'id' => $model->id,
            'party_name' => $model->party_name,
            'ap_ar_type' => $model->ap_ar_type,
            'amount' => $model->amount,
            'due_date' => $model->due_date,
            'reference' => $model->reference,
            'status' => $model->status,
            'created_at' => $model->created_at?->toIso8601String(),
            'updated_at' => $model->updated_at?->toIso8601String(),
        ]);
    }

    /**
     * Create a DTO instance from an array of data.
     *
     * @param array $data The data array
     * @return self New DTO instance populated from the array
     */
    public static function fromArray(array $data): self
    {
        return new self($data);
    }

    /**
     * Convert the DTO to an array representation.
     *
     * @return array Array representation of the DTO
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'party_name' => $this->partyName,
            'ap_ar_type' => $this->apArType,
            'amount' => $this->amount,
            'due_date' => $this->dueDate,
            'reference' => $this->reference,
            'status' => $this->status,
            'created_at' => $this->createdAt,
            'updated_at' => $this->updatedAt,
        ];
    }

    /**
     * Convert the DTO to a model-compatible array for creating/updating.
     *
     * @return array Array suitable for model creation or update
     */
    public function toModel(): array
    {
        return [
            'party_name' => $this->partyName,
            'ap_ar_type' => $this->apArType,
            'amount' => $this->amount,
            'due_date' => $this->dueDate,
            'reference' => $this->reference,
            'status' => $this->status,
        ];
    }
}