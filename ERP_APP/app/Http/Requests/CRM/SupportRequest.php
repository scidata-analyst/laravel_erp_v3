<?php

namespace App\Http\Requests\CRM;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for validating Support Ticket data.
 *
 * Validates fields based on the Support model fillable attributes:
 * - ticket_number: required, string, unique in support_tickets table
 * - customer_id: required, exists in customers table (foreign key relationship)
 * - subject: required, string, max 255
 * - description: required, string, max 2000
 * - priority: nullable, string, max 50
 * - category: nullable, string, max 50
 * - assigned_user_id: nullable, exists in users table (foreign key relationship)
 * - status: nullable, string, max 50
 */
class SupportRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // Get the support ticket ID for unique validation on updates
        $ticketId = $this->route('support');

        return [
            // Ticket number: required, string, max 50 characters, unique in support_tickets
            'ticket_number' => [
                'required',
                'string',
                'max:50',
                "unique:support_tickets,ticket_number,{$ticketId},id",
            ],

            // Customer: required, must exist in customers table
            'customer_id' => ['required', 'exists:App\Models\Sales\Customers,id'],

            // Subject: required, string, max 255 characters
            'subject' => ['required', 'string', 'max:255'],

            // Description: required, string, max 2000 characters
            'description' => ['required', 'string', 'max:2000'],

            // Priority: optional, string, max 50 characters (e.g., low, medium, high, critical)
            'priority' => ['nullable', 'string', 'max:50'],

            // Category: optional, string, max 50 characters (e.g., technical, billing, general)
            'category' => ['nullable', 'string', 'max:50'],

            // Assigned user: optional, must exist in users table
            'assigned_user_id' => ['nullable', 'exists:App\Models\UsersRoles\User,id'],

            // Status: optional, string, max 50 characters (e.g., open, in_progress, resolved, closed)
            'status' => ['nullable', 'string', 'max:50'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'ticket_number.required' => 'The ticket number is required.',
            'ticket_number.max' => 'Ticket number must not exceed 50 characters.',
            'ticket_number.unique' => 'This ticket number is already in use.',
            'customer_id.required' => 'Please select a customer.',
            'customer_id.exists' => 'The selected customer does not exist.',
            'subject.required' => 'The subject is required.',
            'subject.max' => 'Subject must not exceed 255 characters.',
            'description.required' => 'The description is required.',
            'description.max' => 'Description must not exceed 2000 characters.',
            'priority.max' => 'Priority must not exceed 50 characters.',
            'category.max' => 'Category must not exceed 50 characters.',
            'assigned_user_id.exists' => 'The selected user does not exist.',
            'status.max' => 'Status must not exceed 50 characters.',
        ];
    }
}
