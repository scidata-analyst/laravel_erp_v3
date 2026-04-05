<?php

namespace App\DTOs\Accounting;

class GlDTO
{
    public function __construct(
        public readonly string $transaction_date,
        public readonly string $account_name,
        public readonly ?string $account_type = null,
        public readonly float $debit = 0,
        public readonly float $credit = 0,
        public readonly ?string $reference_number = null,
        public readonly ?string $description = null,
        public readonly ?string $status = 'posted',
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            transaction_date: $data['transaction_date'] ?? $data['entry_date'],
            account_name: $data['account_name'],
            account_type: $data['account_type'] ?? null,
            debit: (float) ($data['debit'] ?? 0),
            credit: (float) ($data['credit'] ?? 0),
            reference_number: $data['reference_number'] ?? $data['reference'] ?? null,
            description: $data['description'] ?? null,
            status: $data['status'] ?? 'posted',
        );
    }

    public function toArray(): array
    {
        return [
            'transaction_date' => $this->transaction_date,
            'account_name' => $this->account_name,
            'account_type' => $this->account_type,
            'debit' => $this->debit,
            'credit' => $this->credit,
            'reference_number' => $this->reference_number,
            'description' => $this->description,
            'status' => $this->status,
        ];
    }
}
