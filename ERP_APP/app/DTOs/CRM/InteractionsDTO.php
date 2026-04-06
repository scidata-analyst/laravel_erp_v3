<?php

namespace App\DTOs\CRM;

final class InteractionsDTO
{
    public readonly string $interactionType;
    public readonly ?int $leadId;
    public readonly ?int $customerId;
    public readonly ?int $salesOrderId;
    public readonly ?int $supportTicketId;
    public readonly string $interactionDate;
    public readonly ?string $subject;
    public readonly ?string $description;
    public readonly ?string $nextAction;
    public readonly ?string $nextActionDate;
    public readonly ?int $assignedTo;
    public readonly ?string $status;
    public readonly ?int $createdBy;

    public function __construct(array $data)
    {
        $subjectType = $data['subject_type'] ?? $data['interactable_type'] ?? null;
        $subjectId = isset($data['subject_id']) ? (int)$data['subject_id'] : (isset($data['interactable_id']) ? (int)$data['interactable_id'] : null);

        $this->interactionType = (string)($data['interaction_type'] ?? $data['type'] ?? '');
        $this->leadId = $subjectType === 'lead' ? $subjectId : (isset($data['lead_id']) ? (int)$data['lead_id'] : null);
        $this->customerId = $subjectType === 'customer' ? $subjectId : (isset($data['customer_id']) ? (int)$data['customer_id'] : null);
        $this->salesOrderId = $subjectType === 'sales_order' ? $subjectId : (isset($data['sales_order_id']) ? (int)$data['sales_order_id'] : null);
        $this->supportTicketId = $subjectType === 'support' ? $subjectId : (isset($data['support_ticket_id']) ? (int)$data['support_ticket_id'] : null);
        $this->interactionDate = $data['interaction_date'] ?? '';
        $this->subject = $data['subject'] ?? null;
        $this->description = $data['description'] ?? $data['notes'] ?? $data['details'] ?? null;
        $this->nextAction = $data['next_action'] ?? null;
        $this->nextActionDate = $data['next_action_date'] ?? null;
        $this->assignedTo = isset($data['assigned_to']) ? (int)$data['assigned_to'] : null;
        $this->status = $data['status'] ?? null;
        $this->createdBy = isset($data['created_by']) ? (int)$data['created_by'] : (isset($data['user_id']) ? (int)$data['user_id'] : null);
    }
}