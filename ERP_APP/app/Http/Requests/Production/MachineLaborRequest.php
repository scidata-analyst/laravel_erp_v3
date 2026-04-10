<?php

namespace App\Http\Requests\Production;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for validating Machine/Labor data.
 *
 * Validates fields based on the MachineLabor model fillable attributes:
 * - work_order_id: required, exists in work_orders table (foreign key relationship)
 * - resource_name: required, string, max 100
 * - resource_type: required, string, max 50 (e.g., machine, labor)
 * - hours_used: required, numeric, min 0
 * - cost_per_hour: required, numeric, min 0
 * - total_cost: required, numeric, min 0
 */
class MachineLaborRequest extends FormRequest
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
        // Get the machine/labor ID for unique validation on updates
        $recordId = $this->route('machine_labor');

        return [
            // Work order: required, must exist in work_orders table
            'work_order_id' => ['required', 'exists:App\Models\Production\WorkOrders,id'],

            // Resource name: required, string, max 100 characters
            'resource_name' => ['required', 'string', 'max:100'],

            // Resource type: required, string, max 50 characters (e.g., machine, labor)
            'resource_type' => ['required', 'string', 'max:50'],

            // Hours used: required, numeric, must be 0 or greater
            'hours_used' => ['required', 'numeric', 'min:0'],

            // Cost per hour: required, numeric, must be 0 or greater
            'cost_per_hour' => ['required', 'numeric', 'min:0'],

            // Total cost: required, numeric, must be 0 or greater
            'total_cost' => ['required', 'numeric', 'min:0'],
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
            'work_order_id.required' => 'Please select a work order.',
            'work_order_id.exists' => 'The selected work order does not exist.',
            'resource_name.required' => 'The resource name is required.',
            'resource_name.max' => 'Resource name must not exceed 100 characters.',
            'resource_type.required' => 'The resource type is required.',
            'resource_type.max' => 'Resource type must not exceed 50 characters.',
            'hours_used.required' => 'The hours used is required.',
            'hours_used.numeric' => 'Hours used must be a numeric value.',
            'hours_used.min' => 'Hours used must be at least 0.',
            'cost_per_hour.required' => 'The cost per hour is required.',
            'cost_per_hour.numeric' => 'Cost per hour must be a numeric value.',
            'cost_per_hour.min' => 'Cost per hour must be at least 0.',
            'total_cost.required' => 'The total cost is required.',
            'total_cost.numeric' => 'Total cost must be a numeric value.',
            'total_cost.min' => 'Total cost must be at least 0.',
        ];
    }
}
