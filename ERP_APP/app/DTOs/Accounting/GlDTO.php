<?php

namespace App\DTOs\Accounting;

final class GlDTO
{
    public readonly string $transactionDate;
    public readonly string $accountName;
    public readonly ?string $accountType;
    public readonly float $debit;
    public readonly float $credit;
    public readonly ?string $referenceNumber;
    public readonly ?string $description;
    public readonly ?string $status;

    public function __construct(array $data)
    {
        $this->transactionDate = (string)($data['transaction_date'] ?? $data['entry_date'] ?? '');
        $this->accountName = (string)($data['account_name'] ?? '');
        $this->accountType = $data['account_type'] ?? null;
        $this->debit = (float)($data['debit'] ?? 0);
        $this->credit = (float)($data['credit'] ?? 0);
        $this->referenceNumber = $data['reference_number'] ?? $data['reference'] ?? null;
        $this->description = $data['description'] ?? null;
        $this->status = (string)($data['status'] ?? 'posted');
    }
}