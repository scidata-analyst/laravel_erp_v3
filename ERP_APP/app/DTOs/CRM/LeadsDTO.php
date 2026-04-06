<?php

namespace App\DTOs\CRM;

final class LeadsDTO
{
    public readonly string $leadName;
    public readonly string $email;
    public readonly ?string $company;
    public readonly ?string $phone;
    public readonly ?float $dealValue;
    public readonly ?string $stage;
    public readonly ?int $assignedTo;
    public readonly ?string $source;
    public readonly ?int $probability;
    public readonly ?string $notes;
    public readonly ?string $status;

    public function __construct(array $data)
    {
        $this->leadName = (string)($data['lead_name'] ?? $data['name'] ?? '');
        $this->email = (string)($data['email'] ?? '');
        $this->company = $data['company'] ?? null;
        $this->phone = $data['phone'] ?? null;
        $this->dealValue = isset($data['deal_value']) ? (float)$data['deal_value'] : (isset($data['estimated_value']) ? (float)$data['estimated_value'] : null);
        $this->stage = (string)($data['stage'] ?? 'New');
        $this->assignedTo = isset($data['assigned_to']) ? (int)$data['assigned_to'] : null;
        $this->source = $data['source'] ?? null;
        $this->probability = isset($data['probability']) ? (int)$data['probability'] : 0;
        $this->notes = $data['notes'] ?? null;
        $this->status = $data['status'] ?? null;
    }
}