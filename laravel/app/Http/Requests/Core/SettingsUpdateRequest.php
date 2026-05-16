<?php

namespace App\Http\Requests\Core;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for updating System Settings.
 */
class SettingsUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'company_name' => ['sometimes', 'string', 'max:255'],
            'company_email' => ['sometimes', 'email', 'max:255'],
            'phone_number' => ['sometimes', 'string', 'max:50'],
            'address' => ['sometimes', 'string'],
            'country' => ['sometimes', 'string', 'max:100'],
            'session_timeout_minutes' => ['nullable', 'integer', 'min:5'],
            'two_factor_auth_enabled' => ['nullable', 'boolean'],
            'password_policy' => ['nullable', 'string', 'max:50'],
            'ip_whitelist' => ['nullable', 'string'],
            'email_notifications_enabled' => ['nullable', 'boolean'],
            'low_stock_threshold' => ['nullable', 'integer', 'min:0'],
            'alert_recipients' => ['nullable', 'string'],
            'default_valuation_method' => ['nullable', 'string', 'max:50'],
            'auto_reorder_enabled' => ['nullable', 'boolean'],
            'default_warehouse_id' => ['nullable', 'integer'],
            'status' => ['nullable', 'string', 'max:50'],
        ];
    }

    public function messages(): array
    {
        return [
            'company_email.email' => 'Please enter a valid email address.',
            'session_timeout_minutes.min' => 'Session timeout must be at least 5 minutes.',
        ];
    }
}