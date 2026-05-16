<?php

namespace App\DTOs\Accounting;

use App\Models\Accounting\Tax;

/**
 * Data Transfer Object for Tax configuration.
 * Used for type-safe transfer of tax data.
 */
class TaxDTO
{
    /**
     * Unique identifier of the tax configuration.
     *
     * @var int|null
     */
    public ?int $id;

    /**
     * Name of the tax.
     *
     * @var string|null
     */
    public ?string $taxName;

    /**
     * Type of tax (e.g., VAT, GST, Sales Tax, Income Tax).
     *
     * @var string|null
     */
    public ?string $taxType;

    /**
     * Tax rate (percentage or fixed amount).
     *
     * @var float|null
     */
    public ?float $rate;

    /**
     * Filing period for the tax (e.g., monthly, quarterly, annually).
     *
     * @var string|null
     */
    public ?string $filingPeriod;

    /**
     * Module/transaction where tax is applicable (e.g., sales, purchase).
     *
     * @var string|null
     */
    public ?string $applicableOn;

    /**
     * Status of the tax configuration (0 = inactive, 1 = active).
     *
     * @var int|null
     */
    public ?int $status;

    /**
     * Timestamp when the tax was created.
     *
     * @var string|null
     */
    public ?string $createdAt;

    /**
     * Timestamp when the tax was last updated.
     *
     * @var string|null
     */
    public ?string $updatedAt;

    /**
     * Create a new TaxDTO instance.
     *
     * @param array $data Data array with keys matching DTO properties
     */
    public function __construct(array $data = [])
    {
        $this->id = isset($data['id']) ? (int) $data['id'] : null;
        $this->taxName = $data['tax_name'] ?? null;
        $this->taxType = $data['tax_type'] ?? null;
        $this->rate = isset($data['rate']) ? (float) $data['rate'] : null;
        $this->filingPeriod = $data['filing_period'] ?? null;
        $this->applicableOn = $data['applicable_on'] ?? null;
        $this->status = isset($data['status']) ? (int) $data['status'] : null;
        $this->createdAt = $data['created_at'] ?? null;
        $this->updatedAt = $data['updated_at'] ?? null;
    }

    /**
     * Create a DTO instance from a Tax model.
     *
     * @param Tax $model The Tax model instance
     * @return self New DTO instance populated from the model
     */
    public static function fromModel(Tax $model): self
    {
        return new self([
            'id' => $model->id,
            'tax_name' => $model->tax_name,
            'tax_type' => $model->tax_type,
            'rate' => $model->rate,
            'filing_period' => $model->filing_period,
            'applicable_on' => $model->applicable_on,
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
            'tax_name' => $this->taxName,
            'tax_type' => $this->taxType,
            'rate' => $this->rate,
            'filing_period' => $this->filingPeriod,
            'applicable_on' => $this->applicableOn,
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
            'tax_name' => $this->taxName,
            'tax_type' => $this->taxType,
            'rate' => $this->rate,
            'filing_period' => $this->filingPeriod,
            'applicable_on' => $this->applicableOn,
            'status' => $this->status,
        ];
    }
}