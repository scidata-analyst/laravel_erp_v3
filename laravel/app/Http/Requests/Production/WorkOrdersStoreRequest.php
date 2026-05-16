<?php

namespace App\Http\Requests\Production;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for creating a new Work Order.
 */
class WorkOrdersStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'bom_id' => ['required', 'integer', 'exists:bill_of_materials,id'],
            'quantity_to_produce' => ['required', 'integer', 'min:0'],
            'priority' => ['required', 'string', 'max:20'],
            'start_date' => ['required', 'date'],
            'end_date' => ['nullable', 'date'],
            'workshop_line' => ['required', 'string', 'max:50'],
            'status' => ['nullable', 'string', 'max:50'],
        ];
    }

    public function messages(): array
    {
        return [
            'bom_id.required' => 'The BOM is required.',
            'bom_id.exists' => 'The selected BOM is invalid.',
            'quantity_to_produce.required' => 'The quantity is required.',
            'quantity_to_produce.integer' => 'Quantity must be an integer.',
            'priority.required' => 'The priority is required.',
            'start_date.required' => 'The start date is required.',
            'workshop_line.required' => 'The workshop line is required.',
        ];
    }
}