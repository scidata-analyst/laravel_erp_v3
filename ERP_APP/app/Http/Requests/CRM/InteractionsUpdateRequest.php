<?php

namespace App\Http\Requests\CRM;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for updating an existing Interaction record.
 */
class InteractionsUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'customer_id' => ['sometimes', 'integer', 'exists:customers,id'],
            'contact_person' => ['sometimes', 'string', 'max:100'],
            'interaction_type' => ['sometimes', 'string', 'max:50'],
            'interaction_date' => ['sometimes', 'date'],
            'duration' => ['nullable', 'integer', 'min:0'],
            'summary' => ['sometimes', 'string'],
            'next_action' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'customer_id.exists' => 'The selected customer is invalid.',
            'duration.integer' => 'Duration must be in minutes.',
        ];
    }
}