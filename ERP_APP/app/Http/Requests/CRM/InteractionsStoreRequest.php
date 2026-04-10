<?php

namespace App\Http\Requests\CRM;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for creating a new Interaction record.
 */
class InteractionsStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'customer_id' => ['required', 'integer', 'exists:customers,id'],
            'contact_person' => ['required', 'string', 'max:100'],
            'interaction_type' => ['required', 'string', 'max:50'],
            'interaction_date' => ['required', 'date'],
            'duration' => ['nullable', 'integer', 'min:0'],
            'summary' => ['required', 'string'],
            'next_action' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'customer_id.required' => 'The customer is required.',
            'customer_id.exists' => 'The selected customer is invalid.',
            'contact_person.required' => 'The contact person is required.',
            'interaction_type.required' => 'The interaction type is required.',
            'interaction_date.required' => 'The interaction date is required.',
            'summary.required' => 'The summary is required.',
        ];
    }
}