<?php

namespace App\Http\Requests\Ecommerce;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for updating an existing POS Terminal.
 */
class PosUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $terminalId = $this->route('pos');
        return [
            'terminal_id' => ['sometimes', 'string', 'max:50', 'unique:pos_terminals,terminal_id,' . $terminalId],
            'location' => ['sometimes', 'string', 'max:255'],
            'assigned_cashier_id' => ['nullable', 'integer'],
            'warehouse_id' => ['sometimes', 'integer', 'exists:warehouses,id'],
            'receipt_printer' => ['nullable', 'string', 'max:255'],
            'status' => ['nullable', 'string', 'max:50'],
        ];
    }

    public function messages(): array
    {
        return [
            'terminal_id.unique' => 'The terminal ID must be unique.',
            'warehouse_id.exists' => 'The selected warehouse is invalid.',
        ];
    }
}