<?php

namespace App\DTOs\Reports;

use App\Models\Reports\Forecasting;

/**
 * Data Transfer Object for Forecasting entity.
 *
 * Used for type-safe data transfer between layers
 * and encapsulates demand forecasting data.
 *
 * @property int|null $id
 * @property string|null $forecastName
 * @property string|null $forecastType
 * @property string|null $periodFrom
 * @property string|null $periodTo
 * @property string|null $model
 * @property float|null $accuracyPercentage
 * @property int|null $status
 * @property string|null $createdAt
 * @property string|null $updatedAt
 */
class ForecastingDTO
{
    /** @var int|null Unique identifier */
    public ?int $id;

    /** @var string|null Name of the forecast */
    public ?string $forecastName;

    /** @var string|null Type of forecast (e.g., 'Sales', 'Inventory', 'Demand') */
    public ?string $forecastType;

    /** @var string|null Forecast period start date (Y-m-d) */
    public ?string $periodFrom;

    /** @var string|null Forecast period end date (Y-m-d) */
    public ?string $periodTo;

    /** @var string|null Forecasting model used (e.g., 'Moving Average', 'Linear Regression') */
    public ?string $model;

    /** @var float|null Model accuracy percentage */
    public ?float $accuracyPercentage;

    /** @var int|null Status: 0=Inactive, 1=Active, 2=Running */
    public ?int $status;

    /** @var string|null Creation timestamp (ISO 8601) */
    public ?string $createdAt;

    /** @var string|null Last update timestamp (ISO 8601) */
    public ?string $updatedAt;

    /**
     * Create a new ForecastingDTO instance.
     *
     * @param array $data Optional data array for initialization
     */
    public function __construct(array $data = [])
    {
        $this->id = isset($data['id']) ? (int) $data['id'] : null;
        $this->forecastName = $data['forecast_name'] ?? null;
        $this->forecastType = $data['forecast_type'] ?? null;
        $this->periodFrom = $data['period_from'] ?? null;
        $this->periodTo = $data['period_to'] ?? null;
        $this->model = $data['model'] ?? null;
        $this->accuracyPercentage = isset($data['accuracy_percentage']) ? (float) $data['accuracy_percentage'] : null;
        $this->status = isset($data['status']) ? (int) $data['status'] : null;
        $this->createdAt = $data['created_at'] ?? null;
        $this->updatedAt = $data['updated_at'] ?? null;
    }

    /**
     * Create DTO from Eloquent model instance.
     *
     * @param Forecasting $model Eloquent model to convert
     * @return self New DTO instance with model data
     */
    public static function fromModel(Forecasting $model): self
    {
        return new self([
            'id' => $model->id,
            'forecast_name' => $model->forecast_name,
            'forecast_type' => $model->forecast_type,
            'period_from' => $model->period_from,
            'period_to' => $model->period_to,
            'model' => $model->model,
            'accuracy_percentage' => $model->accuracy_percentage,
            'status' => $model->status,
            'created_at' => $model->created_at?->toIso8601String(),
            'updated_at' => $model->updated_at?->toIso8601String(),
        ]);
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
            'forecast_name' => $this->forecastName,
            'forecast_type' => $this->forecastType,
            'period_from' => $this->periodFrom,
            'period_to' => $this->periodTo,
            'model' => $this->model,
            'accuracy_percentage' => $this->accuracyPercentage,
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
            'forecast_name' => $this->forecastName,
            'forecast_type' => $this->forecastType,
            'period_from' => $this->periodFrom,
            'period_to' => $this->periodTo,
            'model' => $this->model,
            'accuracy_percentage' => $this->accuracyPercentage,
            'status' => $this->status,
        ];
    }
}
