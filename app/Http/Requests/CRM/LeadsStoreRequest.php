<?php

namespace App\Http\Requests\CRM;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for creating a new Lead.
 */
class LeadsStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'lead_name' => ['required', 'string', 'max:255'],
            'company' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:50'],
            'deal_value' => ['nullable', 'numeric', 'min:0'],
            'stage' => ['required', 'string', 'max:50'],
            'assigned_user_id' => ['nullable', 'integer'],
            'notes' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'lead_name.required' => 'The lead name is required.',
            'company.required' => 'The company is required.',
            'email.required' => 'The email is required.',
            'email.email' => 'Please enter a valid email address.',
            'phone.required' => 'The phone number is required.',
            'stage.required' => 'The lead stage is required.',
        ];
    }
}