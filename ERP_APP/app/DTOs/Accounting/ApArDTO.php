<?php

namespace App\DTOs\Accounting;

class ApArDTO
{
    public function __construct(
        public readonly ?string $ref_number = null,
        public readonly string $party_name = '',
        public readonly string $type = '',
        public readonly ?string $due_date = null,
        public readonly float $amount = 0,
        public readonly ?float $paid = 0,
        public readonly ?float $balance = 0,
        public readonly ?string $status = 'pending',
        public readonly ?string $reference = null,
        public readonly ?string $description = null,
    ) {}

    public static function fromRequest(array $data): self
    {
        $amount = (float) ($data['amount'] ?? 0);
        $paid = (float) ($data['paid'] ?? 0);

        return new self(
            ref_number: $data['ref_number'] ?? $data['reference_number'] ?? null,
            party_name: $data['party_name'],
            type: $data['type'] ?? $data['transaction_type'],
            due_date: $data['due_date'] ?? null,
            amount: $amount,
            paid: $paid,
            balance: isset($data['balance']) ? (float) $data['balance'] : max(0, $amount - $paid),
            status: $data['status'] ?? 'pending',
            reference: $data['reference'] ?? $data['party_type'] ?? null,
            description: $data['description'] ?? $data['notes'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'ref_number' => $this->ref_number,
            'party_name' => $this->party_name,
            'type' => $this->type,
            'due_date' => $this->due_date,
            'amount' => $this->amount,
            'paid' => $this->paid,
            'balance' => $this->balance,
            'status' => $this->status,
            'reference' => $this->reference,
            'description' => $this->description,
        ];
    }
}
