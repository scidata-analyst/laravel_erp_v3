<?php

namespace App\DTOs\CRM;

class LeadsDTO
{
    public function __construct(
        public readonly string $lead_name,
        public readonly string $email,
        public readonly ?string $company = null,
        public readonly ?string $phone = null,
        public readonly ?float $deal_value = null,
        public readonly ?string $stage = 'New',
        public readonly ?int $assigned_to = null,
        public readonly ?string $source = null,
        public readonly ?int $probability = 0,
        public readonly ?string $notes = null,
        public readonly ?string $status = null,
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            lead_name: $data['lead_name'] ?? $data['name'],
            email: $data['email'],
            company: $data['company'] ?? null,
            phone: $data['phone'] ?? null,
            deal_value: isset($data['deal_value']) ? (float) $data['deal_value'] : (isset($data['estimated_value']) ? (float) $data['estimated_value'] : null),
            stage: $data['stage'] ?? 'New',
            assigned_to: isset($data['assigned_to']) ? (int) $data['assigned_to'] : null,
            source: $data['source'] ?? null,
            probability: isset($data['probability']) ? (int) $data['probability'] : 0,
            notes: $data['notes'] ?? null,
            status: $data['status'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'lead_name' => $this->lead_name,
            'email' => $this->email,
            'company' => $this->company,
            'phone' => $this->phone,
            'deal_value' => $this->deal_value,
            'stage' => $this->stage,
            'assigned_to' => $this->assigned_to,
            'source' => $this->source,
            'probability' => $this->probability,
            'notes' => $this->notes,
            'status' => $this->status,
        ];
    }
}
