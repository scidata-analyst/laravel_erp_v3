<?php

namespace App\DTOs\CRM;

class InteractionsDTO
{
    public function __construct(
        public readonly string $interaction_type,
        public readonly ?int $lead_id = null,
        public readonly ?int $customer_id = null,
        public readonly ?int $sales_order_id = null,
        public readonly ?int $support_ticket_id = null,
        public readonly string $interaction_date = '',
        public readonly ?string $subject = null,
        public readonly ?string $description = null,
        public readonly ?string $next_action = null,
        public readonly ?string $next_action_date = null,
        public readonly ?int $assigned_to = null,
        public readonly ?string $status = null,
        public readonly ?int $created_by = null,
    ) {}

    public static function fromRequest(array $data): self
    {
        $subjectType = $data['subject_type'] ?? $data['interactable_type'] ?? null;
        $subjectId = isset($data['subject_id']) ? (int) $data['subject_id'] : (isset($data['interactable_id']) ? (int) $data['interactable_id'] : null);

        return new self(
            interaction_type: $data['interaction_type'] ?? $data['type'],
            lead_id: $subjectType === 'lead' ? $subjectId : (isset($data['lead_id']) ? (int) $data['lead_id'] : null),
            customer_id: $subjectType === 'customer' ? $subjectId : (isset($data['customer_id']) ? (int) $data['customer_id'] : null),
            sales_order_id: $subjectType === 'sales_order' ? $subjectId : (isset($data['sales_order_id']) ? (int) $data['sales_order_id'] : null),
            support_ticket_id: $subjectType === 'support' ? $subjectId : (isset($data['support_ticket_id']) ? (int) $data['support_ticket_id'] : null),
            interaction_date: $data['interaction_date'] ?? '',
            subject: $data['subject'] ?? null,
            description: $data['description'] ?? $data['notes'] ?? $data['details'] ?? null,
            next_action: $data['next_action'] ?? null,
            next_action_date: $data['next_action_date'] ?? null,
            assigned_to: isset($data['assigned_to']) ? (int) $data['assigned_to'] : null,
            status: $data['status'] ?? null,
            created_by: isset($data['created_by']) ? (int) $data['created_by'] : (isset($data['user_id']) ? (int) $data['user_id'] : auth()->id()),
        );
    }

    public function toArray(): array
    {
        return [
            'interaction_type' => $this->interaction_type,
            'lead_id' => $this->lead_id,
            'customer_id' => $this->customer_id,
            'sales_order_id' => $this->sales_order_id,
            'support_ticket_id' => $this->support_ticket_id,
            'interaction_date' => $this->interaction_date,
            'subject' => $this->subject,
            'description' => $this->description,
            'next_action' => $this->next_action,
            'next_action_date' => $this->next_action_date,
            'assigned_to' => $this->assigned_to,
            'status' => $this->status,
            'created_by' => $this->created_by,
        ];
    }
}
