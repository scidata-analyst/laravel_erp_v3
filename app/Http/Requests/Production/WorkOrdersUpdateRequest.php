<?php

namespace App\Http\Requests\Production;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for updating an existing Work Order.
 */
class WorkOrdersUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'bom_id' => ['sometimes', 'integer', 'exists:bill_of_materials,id'],
            'quantity_to_produce' => ['sometimes', 'integer', 'min:0'],
            'priority' => ['sometimes', 'string', 'max:20'],
            'start_date' => ['sometimes', 'date'],
            'end_date' => ['nullable', 'date'],
            'workshop_line' => ['sometimes', 'string', 'max:50'],
            'status' => ['nullable', 'string', 'max:50'],
        ];
    }

    public function messages(): array
    {
        return [
            'bom_id.exists' => 'The selected BOM is invalid.',
            'quantity_to_produce.integer' => 'Quantity must be an integer.',
        ];
    }
}