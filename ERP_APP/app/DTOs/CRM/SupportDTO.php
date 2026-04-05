<?php

namespace App\DTOs\CRM;

class SupportDTO
{
    public function __construct(
        public readonly ?string $ticket_number = null,
        public readonly ?int $customer_id = null,
        public readonly ?int $lead_id = null,
        public readonly string $subject = '',
        public readonly string $description = '',
        public readonly ?string $priority = 'medium',
        public readonly ?string $category = 'general',
        public readonly ?int $assigned_to = null,
        public readonly ?string $status = 'open',
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            ticket_number: $data['ticket_number'] ?? null,
            customer_id: isset($data['customer_id']) ? (int) $data['customer_id'] : null,
            lead_id: isset($data['lead_id']) ? (int) $data['lead_id'] : null,
            subject: $data['subject'] ?? '',
            description: $data['description'] ?? $data['comments'] ?? '',
            priority: isset($data['priority']) ? strtolower((string) $data['priority']) : 'medium',
            category: isset($data['category']) ? strtolower((string) $data['category']) : 'general',
            assigned_to: isset($data['assigned_to']) ? (int) $data['assigned_to'] : null,
            status: isset($data['status']) ? strtolower((string) $data['status']) : 'open',
        );
    }

    public function toArray(): array
    {
        return [
            'ticket_number' => $this->ticket_number,
            'customer_id' => $this->customer_id,
            'lead_id' => $this->lead_id,
            'subject' => $this->subject,
            'description' => $this->description,
            'priority' => $this->priority,
            'category' => $this->category,
            'assigned_to' => $this->assigned_to,
            'status' => $this->status,
        ];
    }
}
