<?php

namespace App\Http\Requests\CRM;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for creating a new Support Ticket.
 */
class SupportStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'ticket_number' => ['required', 'string', 'max:50', 'unique:support_tickets,ticket_number'],
            'customer_id' => ['required', 'integer', 'exists:customers,id'],
            'subject' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'priority' => ['required', 'string', 'max:20'],
            'category' => ['required', 'string', 'max:50'],
            'assigned_user_id' => ['nullable', 'integer'],
            'status' => ['nullable', 'string', 'max:50'],
        ];
    }

    public function messages(): array
    {
        return [
            'ticket_number.required' => 'The ticket number is required.',
            'ticket_number.unique' => 'The ticket number must be unique.',
            'customer_id.required' => 'The customer is required.',
            'customer_id.exists' => 'The selected customer is invalid.',
            'subject.required' => 'The subject is required.',
            'description.required' => 'The description is required.',
            'priority.required' => 'The priority is required.',
            'category.required' => 'The category is required.',
        ];
    }
}