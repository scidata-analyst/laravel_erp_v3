<?php

namespace App\Http\Requests\Production;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for creating a new Machine Labor record.
 */
class MachineLaborStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'work_order_id' => ['required', 'integer', 'exists:work_orders,id'],
            'resource_name' => ['required', 'string', 'max:255'],
            'resource_type' => ['required', 'string', 'max:50'],
            'hours_used' => ['required', 'numeric', 'min:0'],
            'cost_per_hour' => ['required', 'numeric', 'min:0'],
            'total_cost' => ['required', 'numeric', 'min:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'work_order_id.required' => 'The work order is required.',
            'work_order_id.exists' => 'The selected work order is invalid.',
            'resource_name.required' => 'The resource name is required.',
            'resource_type.required' => 'The resource type is required.',
            'hours_used.required' => 'The hours used is required.',
            'cost_per_hour.required' => 'The cost per hour is required.',
            'total_cost.required' => 'The total cost is required.',
        ];
    }
}