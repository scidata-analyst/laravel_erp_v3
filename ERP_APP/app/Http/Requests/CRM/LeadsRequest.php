<?php

namespace App\Http\Requests\CRM;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for validating Lead data.
 *
 * Validates fields based on the Leads model fillable attributes:
 * - lead_name: required, string, max 255
 * - company: nullable, string, max 255
 * - email: required, email
 * - phone: nullable, string, max 20
 * - deal_value: nullable, numeric, min 0
 * - stage: nullable, string, max 50
 * - assigned_user_id: nullable, exists in users table (foreign key relationship)
 * - notes: nullable, string, max 1000
 */
class LeadsRequest extends FormRequest
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
        // Get the lead ID for unique validation on updates
        $leadId = $this->route('lead');

        return [
            // Lead name: required, string, max 255 characters
            'lead_name' => ['required', 'string', 'max:255'],

            // Company: optional, string, max 255 characters
            'company' => ['nullable', 'string', 'max:255'],

            // Email: required, valid email format
            'email' => ['required', 'email', 'max:255'],

            // Phone: optional, string, max 20 characters
            'phone' => ['nullable', 'string', 'max:20'],

            // Deal value: optional, numeric, must be 0 or greater
            'deal_value' => ['nullable', 'numeric', 'min:0'],

            // Stage: optional, string, max 50 characters (e.g., new, contacted, qualified, won, lost)
            'stage' => ['nullable', 'string', 'max:50'],

            // Assigned user: optional, must exist in users table
            'assigned_user_id' => ['nullable', 'exists:App\Models\UsersRoles\User,id'],

            // Notes: optional, string, max 1000 characters
            'notes' => ['nullable', 'string', 'max:1000'],
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
            'lead_name.required' => 'The lead name is required.',
            'lead_name.max' => 'Lead name must not exceed 255 characters.',
            'company.max' => 'Company name must not exceed 255 characters.',
            'email.required' => 'The email address is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.max' => 'Email must not exceed 255 characters.',
            'phone.max' => 'Phone number must not exceed 20 characters.',
            'deal_value.numeric' => 'Deal value must be a numeric value.',
            'deal_value.min' => 'Deal value must be at least 0.',
            'stage.max' => 'Stage must not exceed 50 characters.',
            'assigned_user_id.exists' => 'The selected user does not exist.',
            'notes.max' => 'Notes must not exceed 1000 characters.',
        ];
    }
}
