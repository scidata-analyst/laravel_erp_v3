<?php

namespace App\Http\Requests\Production;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for validating Work Order data.
 *
 * Validates fields based on the WorkOrders model fillable attributes:
 * - bom_id: required, exists in bill_of_materials table (foreign key relationship)
 * - quantity_to_produce: required, integer, min 1
 * - priority: nullable, string, max 50
 * - start_date: required, date
 * - end_date: nullable, date, must be after or equal to start_date
 * - workshop_line: nullable, string, max 100
 * - status: nullable, string, max 50
 */
class WorkOrdersRequest extends FormRequest
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
        // Get the work order ID for unique validation on updates
        $orderId = $this->route('work_order');

        return [
            // BOM: required, must exist in bill_of_materials table
            'bom_id' => ['required', 'exists:App\Models\Production\Bom,id'],

            // Quantity to produce: required, integer, must be at least 1
            'quantity_to_produce' => ['required', 'integer', 'min:1'],

            // Priority: optional, string, max 50 characters (e.g., low, medium, high, urgent)
            'priority' => ['nullable', 'string', 'max:50'],

            // Start date: required, must be a valid date
            'start_date' => ['required', 'date'],

            // End date: optional, must be a valid date
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],

            // Workshop line: optional, string, max 100 characters
            'workshop_line' => ['nullable', 'string', 'max:100'],

            // Status: optional, string, max 50 characters (e.g., pending, in_progress, completed)
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
            'bom_id.required' => 'Please select a Bill of Materials.',
            'bom_id.exists' => 'The selected BOM does not exist.',
            'quantity_to_produce.required' => 'The quantity to produce is required.',
            'quantity_to_produce.integer' => 'Quantity must be an integer.',
            'quantity_to_produce.min' => 'Quantity must be at least 1.',
            'priority.max' => 'Priority must not exceed 50 characters.',
            'start_date.required' => 'The start date is required.',
            'start_date.date' => 'Please enter a valid date.',
            'end_date.date' => 'Please enter a valid date.',
            'end_date.after_or_equal' => 'End date must be on or after the start date.',
            'workshop_line.max' => 'Workshop line must not exceed 100 characters.',
            'status.max' => 'Status must not exceed 50 characters.',
        ];
    }
}
