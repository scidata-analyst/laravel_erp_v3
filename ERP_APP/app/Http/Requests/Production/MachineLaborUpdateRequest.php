<?php

namespace App\Http\Requests\Production;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for updating an existing Machine Labor record.
 */
class MachineLaborUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'work_order_id' => ['sometimes', 'integer', 'exists:work_orders,id'],
            'resource_name' => ['sometimes', 'string', 'max:255'],
            'resource_type' => ['sometimes', 'string', 'max:50'],
            'hours_used' => ['sometimes', 'numeric', 'min:0'],
            'cost_per_hour' => ['sometimes', 'numeric', 'min:0'],
            'total_cost' => ['sometimes', 'numeric', 'min:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'work_order_id.exists' => 'The selected work order is invalid.',
        ];
    }
}