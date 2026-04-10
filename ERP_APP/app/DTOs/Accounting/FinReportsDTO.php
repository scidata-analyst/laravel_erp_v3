<?php

namespace App\DTOs\Accounting;

use App\Models\Accounting\FinReports;

/**
 * Data Transfer Object for Financial Reports.
 * Used for type-safe transfer of financial report data.
 */
class FinReportsDTO
{
    /**
     * Unique identifier of the financial report.
     *
     * @var int|null
     */
    public ?int $id;

    /**
     * Type of financial report (e.g., P&L, Balance Sheet, Cash Flow).
     *
     * @var string|null
     */
    public ?string $type;

    /**
     * Reporting period (e.g., monthly, quarterly, yearly).
     *
     * @var string|null
     */
    public ?string $period;

    /**
     * Start date of the report period.
     *
     * @var string|null
     */
    public ?string $startDate;

    /**
     * End date of the report period.
     *
     * @var string|null
     */
    public ?string $endDate;

    /**
     * Output format of the report (e.g., PDF, Excel, CSV).
     *
     * @var string|null
     */
    public ?string $format;

    /**
     * Timestamp when the report was created.
     *
     * @var string|null
     */
    public ?string $createdAt;

    /**
     * Timestamp when the report was last updated.
     *
     * @var string|null
     */
    public ?string $updatedAt;

    /**
     * Create a new FinReportsDTO instance.
     *
     * @param array $data Data array with keys matching DTO properties
     */
    public function __construct(array $data = [])
    {
        $this->id = isset($data['id']) ? (int) $data['id'] : null;
        $this->type = $data['type'] ?? null;
        $this->period = $data['period'] ?? null;
        $this->startDate = $data['start_date'] ?? null;
        $this->endDate = $data['end_date'] ?? null;
        $this->format = $data['format'] ?? null;
        $this->createdAt = $data['created_at'] ?? null;
        $this->updatedAt = $data['updated_at'] ?? null;
    }

    /**
     * Create a DTO instance from a FinReports model.
     *
     * @param FinReports $model The FinReports model instance
     * @return self New DTO instance populated from the model
     */
    public static function fromModel(FinReports $model): self
    {
        return new self([
            'id' => $model->id,
            'type' => $model->type,
            'period' => $model->period,
            'start_date' => $model->start_date,
            'end_date' => $model->end_date,
            'format' => $model->format,
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
            'type' => $this->type,
            'period' => $this->period,
            'start_date' => $this->startDate,
            'end_date' => $this->endDate,
            'format' => $this->format,
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
            'type' => $this->type,
            'period' => $this->period,
            'start_date' => $this->startDate,
            'end_date' => $this->endDate,
            'format' => $this->format,
        ];
    }
}