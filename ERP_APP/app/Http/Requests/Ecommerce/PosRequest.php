<?php

namespace App\Http\Requests\Ecommerce;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for validating POS Terminal data.
 *
 * Validates fields based on the Pos model fillable attributes:
 * - terminal_id: required, string, max 50
 * - location: required, string, max 100
 * - assigned_cashier_id: nullable, exists in users table (foreign key relationship)
 * - warehouse_id: nullable, exists in warehouses table (foreign key relationship)
 * - receipt_printer: nullable, string, max 100
 * - status: nullable, string, max 50
 */
class PosRequest extends FormRequest
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
        // Get the POS terminal ID for unique validation on updates
        $posId = $this->route('pos');

        return [
            // Terminal ID: required, string, max 50 characters
            'terminal_id' => ['required', 'string', 'max:50'],

            // Location: required, string, max 100 characters
            'location' => ['required', 'string', 'max:100'],

            // Assigned cashier: optional, must exist in users table
            'assigned_cashier_id' => ['nullable', 'exists:App\Models\UsersRoles\User,id'],

            // Warehouse: optional, must exist in warehouses table
            'warehouse_id' => ['nullable', 'exists:App\Models\Logistics\Warehouses,id'],

            // Receipt printer: optional, string, max 100 characters
            'receipt_printer' => ['nullable', 'string', 'max:100'],

            // Status: optional, string, max 50 characters (e.g., active, inactive, offline)
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
            'terminal_id.required' => 'The terminal ID is required.',
            'terminal_id.max' => 'Terminal ID must not exceed 50 characters.',
            'location.required' => 'The location is required.',
            'location.max' => 'Location must not exceed 100 characters.',
            'assigned_cashier_id.exists' => 'The selected cashier does not exist.',
            'warehouse_id.exists' => 'The selected warehouse does not exist.',
            'receipt_printer.max' => 'Receipt printer must not exceed 100 characters.',
            'status.max' => 'Status must not exceed 50 characters.',
        ];
    }
}
