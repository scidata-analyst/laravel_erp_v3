<?php

namespace App\DTOs\Accounting;

use App\Models\Accounting\ApAr;

class ApArDTO
{
    public ?int $id;

    public ?string $partyName;

    public ?string $apArType;

    public ?float $amount;

    public ?string $dueDate;

    public ?string $reference;

    public ?int $status;

    public ?string $createdAt;

    public ?string $updatedAt;

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

    public static function fromArray(array $data): self
    {
        return new self($data);
    }

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
