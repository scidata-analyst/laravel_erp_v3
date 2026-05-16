<?php

namespace App\Http\Requests\Ecommerce;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for creating a new POS Terminal.
 */
class PosStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'terminal_id' => ['required', 'string', 'max:50', 'unique:pos_terminals,terminal_id'],
            'location' => ['required', 'string', 'max:255'],
            'assigned_cashier_id' => ['nullable', 'integer'],
            'warehouse_id' => ['required', 'integer', 'exists:warehouses,id'],
            'receipt_printer' => ['nullable', 'string', 'max:255'],
            'status' => ['nullable', 'string', 'max:50'],
        ];
    }

    public function messages(): array
    {
        return [
            'terminal_id.required' => 'The terminal ID is required.',
            'terminal_id.unique' => 'The terminal ID must be unique.',
            'location.required' => 'The location is required.',
            'warehouse_id.required' => 'The warehouse is required.',
            'warehouse_id.exists' => 'The selected warehouse is invalid.',
        ];
    }
}