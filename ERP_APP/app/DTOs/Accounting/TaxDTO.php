<?php

namespace App\DTOs\Accounting;

use App\Models\Accounting\Tax;

class TaxDTO
{
    public ?int $id;

    public ?string $taxName;

    public ?string $taxType;

    public ?float $rate;

    public ?string $filingPeriod;

    public ?string $applicableOn;

    public ?int $status;

    public ?string $createdAt;

    public ?string $updatedAt;

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

    public static function fromArray(array $data): self
    {
        return new self($data);
    }

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
