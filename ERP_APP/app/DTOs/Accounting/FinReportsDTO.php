<?php

namespace App\DTOs\Accounting;

use App\Models\Accounting\FinReports;

class FinReportsDTO
{
    public ?int $id;

    public ?string $type;

    public ?string $period;

    public ?string $startDate;

    public ?string $endDate;

    public ?string $format;

    public ?string $createdAt;

    public ?string $updatedAt;

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

    public static function fromArray(array $data): self
    {
        return new self($data);
    }

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
