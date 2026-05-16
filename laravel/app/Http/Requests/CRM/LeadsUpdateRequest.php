<?php

namespace App\Http\Requests\CRM;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for updating an existing Lead.
 */
class LeadsUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'lead_name' => ['sometimes', 'string', 'max:255'],
            'company' => ['sometimes', 'string', 'max:255'],
            'email' => ['sometimes', 'email', 'max:255'],
            'phone' => ['sometimes', 'string', 'max:50'],
            'deal_value' => ['nullable', 'numeric', 'min:0'],
            'stage' => ['sometimes', 'string', 'max:50'],
            'assigned_user_id' => ['nullable', 'integer'],
            'notes' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'email.email' => 'Please enter a valid email address.',
        ];
    }
}