<?php

namespace App\Http\Requests\CRM;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for validating Interaction data.
 *
 * Validates fields based on the Interactions model fillable attributes:
 * - customer_id: required, exists in customers table (foreign key relationship)
 * - contact_person: nullable, string, max 255
 * - interaction_type: required, string, max 50
 * - interaction_date: required, date
 * - duration: nullable, integer, min 0 (in minutes)
 * - summary: nullable, string, max 1000
 * - next_action: nullable, string, max 500
 */
class InteractionsRequest extends FormRequest
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
        // Get the interaction ID for unique validation on updates
        $interactionId = $this->route('interaction');

        return [
            // Customer: required, must exist in customers table
            'customer_id' => ['required', 'exists:App\Models\Sales\Customers,id'],

            // Contact person: optional, string, max 255 characters
            'contact_person' => ['nullable', 'string', 'max:255'],

            // Interaction type: required, string, max 50 characters (e.g., call, email, meeting)
            'interaction_type' => ['required', 'string', 'max:50'],

            // Interaction date: required, must be a valid date
            'interaction_date' => ['required', 'date'],

            // Duration: optional, integer, must be 0 or greater (in minutes)
            'duration' => ['nullable', 'integer', 'min:0'],

            // Summary: optional, string, max 1000 characters
            'summary' => ['nullable', 'string', 'max:1000'],

            // Next action: optional, string, max 500 characters
            'next_action' => ['nullable', 'string', 'max:500'],
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
            'customer_id.required' => 'Please select a customer.',
            'customer_id.exists' => 'The selected customer does not exist.',
            'contact_person.max' => 'Contact person must not exceed 255 characters.',
            'interaction_type.required' => 'The interaction type is required.',
            'interaction_type.max' => 'Interaction type must not exceed 50 characters.',
            'interaction_date.required' => 'The interaction date is required.',
            'interaction_date.date' => 'Please enter a valid date.',
            'duration.integer' => 'Duration must be an integer (in minutes).',
            'duration.min' => 'Duration must be at least 0.',
            'summary.max' => 'Summary must not exceed 1000 characters.',
            'next_action.max' => 'Next action must not exceed 500 characters.',
        ];
    }
}
