<?php

namespace App\Http\Requests\CRM;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for updating an existing Support Ticket.
 */
class SupportUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $ticketId = $this->route('support');
        return [
            'ticket_number' => ['sometimes', 'string', 'max:50', 'unique:support_tickets,ticket_number,' . $ticketId],
            'customer_id' => ['sometimes', 'integer', 'exists:customers,id'],
            'subject' => ['sometimes', 'string', 'max:255'],
            'description' => ['sometimes', 'string'],
            'priority' => ['sometimes', 'string', 'max:20'],
            'category' => ['sometimes', 'string', 'max:50'],
            'assigned_user_id' => ['nullable', 'integer'],
            'status' => ['nullable', 'string', 'max:50'],
        ];
    }

    public function messages(): array
    {
        return [
            'ticket_number.unique' => 'The ticket number must be unique.',
            'customer_id.exists' => 'The selected customer is invalid.',
        ];
    }
}