<?php

namespace App\DTOs\Accounting;

final class ApArDTO
{
    public readonly ?string $refNumber;
    public readonly string $partyName;
    public readonly string $type;
    public readonly ?string $dueDate;
    public readonly float $amount;
    public readonly float $paid;
    public readonly float $balance;
    public readonly string $status;
    public readonly ?string $description;

    public function __construct(array $data)
    {
        $this->refNumber = (string)($data['ref_number'] ?? '');
        $this->partyName = (string)($data['party_name'] ?? '');
        $this->type = (string)($data['type'] ?? '');
        $this->dueDate = $data['due_date'] ?? null;
        $this->amount = (float)($data['amount'] ?? 0);
        $this->paid = (float)($data['paid'] ?? 0);
        $this->balance = (float)($data['balance'] ?? $this->amount - $this->paid);
        $this->status = (string)($data['status'] ?? 'pending');
        $this->description = $data['description'] ?? null;
    }
}