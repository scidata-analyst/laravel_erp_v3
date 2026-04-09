<?php

namespace App\DTOs\Accounting;

use App\Models\Accounting\Gl;

class GlDTO
{
    public ?int $id;

    public ?string $name;

    public ?string $type;

    public ?string $code;

    public ?float $debit;

    public ?float $credit;

    public ?string $narration;

    public ?string $createdAt;

    public ?string $updatedAt;

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

    public static function fromArray(array $data): self
    {
        return new self($data);
    }

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
