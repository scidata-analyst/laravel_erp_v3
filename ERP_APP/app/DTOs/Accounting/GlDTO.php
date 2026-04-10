<?php

namespace App\DTOs\Accounting;

use App\Models\Accounting\Gl;

/**
 * Data Transfer Object for General Ledger entries.
 * Used for type-safe transfer of GL transaction data.
 */
class GlDTO
{
    /**
     * Unique identifier of the GL entry.
     *
     * @var int|null
     */
    public ?int $id;

    /**
     * Name of the account or transaction.
     *
     * @var string|null
     */
    public ?string $name;

    /**
     * Type of GL entry (e.g., Asset, Liability, Income, Expense).
     *
     * @var string|null
     */
    public ?string $type;

    /**
     * Account code for the GL entry.
     *
     * @var string|null
     */
    public ?string $code;

    /**
     * Debit amount.
     *
     * @var float|null
     */
    public ?float $debit;

    /**
     * Credit amount.
     *
     * @var float|null
     */
    public ?float $credit;

    /**
     * Description or explanation of the transaction.
     *
     * @var string|null
     */
    public ?string $narration;

    /**
     * Timestamp when the GL entry was created.
     *
     * @var string|null
     */
    public ?string $createdAt;

    /**
     * Timestamp when the GL entry was last updated.
     *
     * @var string|null
     */
    public ?string $updatedAt;

    /**
     * Create a new GlDTO instance.
     *
     * @param array $data Data array with keys matching DTO properties
     */
    public function __construct(array $data = [])
    {
        $this->id = isset($data['id']) ? (int) $data['id'] : null;
        $this->name = $data['name'] ?? null;
        $this->type = $data['type'] ?? null;
        $this->code = $data['code'] ?? null;
        $this->debit = isset($data['debit']) ? (float) $data['debit'] : null;
        $this->credit = isset($data['credit']) ? (float) $data['credit'] : null;
        $this->narration = $data['narration'] ?? null;
        $this->createdAt = $data['created_at'] ?? null;
        $this->updatedAt = $data['updated_at'] ?? null;
    }

    /**
     * Create a DTO instance from a Gl model.
     *
     * @param Gl $model The Gl model instance
     * @return self New DTO instance populated from the model
     */
    public static function fromModel(Gl $model): self
    {
        return new self([
            'id' => $model->id,
            'name' => $model->name,
            'type' => $model->type,
            'code' => $model->code,
            'debit' => $model->debit,
            'credit' => $model->credit,
            'narration' => $model->narration,
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
            'name' => $this->name,
            'type' => $this->type,
            'code' => $this->code,
            'debit' => $this->debit,
            'credit' => $this->credit,
            'narration' => $this->narration,
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
            'name' => $this->name,
            'type' => $this->type,
            'code' => $this->code,
            'debit' => $this->debit,
            'credit' => $this->credit,
            'narration' => $this->narration,
        ];
    }
}