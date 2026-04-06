<?php

namespace App\DTOs\CRM;

final class SupportDTO
{
    public readonly ?string $ticketNumber;
    public readonly ?int $customerId;
    public readonly ?int $leadId;
    public readonly string $subject;
    public readonly string $description;
    public readonly ?string $priority;
    public readonly ?string $category;
    public readonly ?int $assignedTo;
    public readonly ?string $status;

    public function __construct(array $data)
    {
        $this->ticketNumber = $data['ticket_number'] ?? null;
        $this->customerId = isset($data['customer_id']) ? (int)$data['customer_id'] : null;
        $this->leadId = isset($data['lead_id']) ? (int)$data['lead_id'] : null;
        $this->subject = (string)($data['subject'] ?? '');
        $this->description = (string)($data['description'] ?? $data['comments'] ?? '');
        $this->priority = isset($data['priority']) ? strtolower((string)$data['priority']) : 'medium';
        $this->category = isset($data['category']) ? strtolower((string)$data['category']) : 'general';
        $this->assignedTo = isset($data['assigned_to']) ? (int)$data['assigned_to'] : null;
        $this->status = isset($data['status']) ? strtolower((string)$data['status']) : 'open';
    }
}