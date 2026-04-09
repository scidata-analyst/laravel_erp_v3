<?php

namespace App\DTOs\Reports;

use App\Models\Reports\Forecasting;

class ForecastingDTO
{
    public ?int $id;

    public ?string $forecastName;

    public ?string $forecastType;

    public ?string $periodFrom;

    public ?string $periodTo;

    public ?string $model;

    public ?float $accuracyPercentage;

    public ?int $status;

    public ?string $createdAt;

    public ?string $updatedAt;

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

    public static function fromArray(array $data): self
    {
        return new self($data);
    }

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
