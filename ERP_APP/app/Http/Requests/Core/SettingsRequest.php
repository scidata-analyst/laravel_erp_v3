<?php

namespace App\Http\Requests\Core;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for validating System Settings data.
 *
 * Validates fields based on the Settings model fillable attributes:
 * - company_name: required, string, max 255
 * - company_email: required, email, max 255
 * - phone_number: nullable, string, max 20
 * - address: nullable, string, max 500
 * - country: nullable, string, max 100
 * - session_timeout_minutes: nullable, integer, min 1
 * - two_factor_auth_enabled: nullable, boolean
 * - password_policy: nullable, string, max 500
 * - ip_whitelist: nullable, string, max 500
 * - email_notifications_enabled: nullable, boolean
 * - low_stock_threshold: nullable, integer, min 0
 * - alert_recipients: nullable, string, max 500
 * - default_valuation_method: nullable, string, max 50
 * - auto_reorder_enabled: nullable, boolean
 * - default_warehouse_id: nullable, exists in warehouses table (foreign key relationship)
 * - status: nullable, string, max 50
 */
class SettingsRequest extends FormRequest
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
        // Get the settings ID for unique validation on updates
        $settingsId = $this->route('settings');

        return [
            // Company name: required, string, max 255 characters
            'company_name' => ['required', 'string', 'max:255'],

            // Company email: required, valid email format, max 255 characters
            'company_email' => ['required', 'email', 'max:255'],

            // Phone number: optional, string, max 20 characters
            'phone_number' => ['nullable', 'string', 'max:20'],

            // Address: optional, string, max 500 characters
            'address' => ['nullable', 'string', 'max:500'],

            // Country: optional, string, max 100 characters
            'country' => ['nullable', 'string', 'max:100'],

            // Session timeout minutes: optional, integer, must be at least 1
            'session_timeout_minutes' => ['nullable', 'integer', 'min:1'],

            // Two factor auth enabled: optional, must be a valid boolean
            'two_factor_auth_enabled' => ['nullable', 'boolean'],

            // Password policy: optional, string, max 500 characters
            'password_policy' => ['nullable', 'string', 'max:500'],

            // IP whitelist: optional, string, max 500 characters
            'ip_whitelist' => ['nullable', 'string', 'max:500'],

            // Email notifications enabled: optional, must be a valid boolean
            'email_notifications_enabled' => ['nullable', 'boolean'],

            // Low stock threshold: optional, integer, must be 0 or greater
            'low_stock_threshold' => ['nullable', 'integer', 'min:0'],

            // Alert recipients: optional, string, max 500 characters
            'alert_recipients' => ['nullable', 'string', 'max:500'],

            // Default valuation method: optional, string, max 50 characters
            'default_valuation_method' => ['nullable', 'string', 'max:50'],

            // Auto reorder enabled: optional, must be a valid boolean
            'auto_reorder_enabled' => ['nullable', 'boolean'],

            // Default warehouse: optional, must exist in warehouses table
            'default_warehouse_id' => ['nullable', 'exists:App\Models\Logistics\Warehouses,id'],

            // Status: optional, string, max 50 characters (e.g., active, inactive)
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
            'company_name.required' => 'The company name is required.',
            'company_name.max' => 'Company name must not exceed 255 characters.',
            'company_email.required' => 'The company email is required.',
            'company_email.email' => 'Please enter a valid email address.',
            'company_email.max' => 'Company email must not exceed 255 characters.',
            'phone_number.max' => 'Phone number must not exceed 20 characters.',
            'address.max' => 'Address must not exceed 500 characters.',
            'country.max' => 'Country must not exceed 100 characters.',
            'session_timeout_minutes.integer' => 'Session timeout must be an integer.',
            'session_timeout_minutes.min' => 'Session timeout must be at least 1 minute.',
            'password_policy.max' => 'Password policy must not exceed 500 characters.',
            'ip_whitelist.max' => 'IP whitelist must not exceed 500 characters.',
            'low_stock_threshold.integer' => 'Low stock threshold must be an integer.',
            'low_stock_threshold.min' => 'Low stock threshold must be at least 0.',
            'alert_recipients.max' => 'Alert recipients must not exceed 500 characters.',
            'default_valuation_method.max' => 'Default valuation method must not exceed 50 characters.',
            'default_warehouse_id.exists' => 'The selected warehouse does not exist.',
            'status.max' => 'Status must not exceed 50 characters.',
        ];
    }
}
