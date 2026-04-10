<?php

namespace App\Http\Requests\Logistics;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for validating Shipment data.
 *
 * Validates fields based on the Shipments model fillable attributes:
 * - sales_order_id: required, exists in sales_orders table (foreign key relationship)
 * - carrier: nullable, string, max 100
 * - tracking_number: nullable, string, max 100
 * - estimated_delivery_date: nullable, date
 * - shipping_address: required, string, max 500
 * - status: nullable, string, max 50
 */
class ShipmentsRequest extends FormRequest
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
        // Get the shipment ID for unique validation on updates
        $shipmentId = $this->route('shipment');

        return [
            // Sales order: required, must exist in sales_orders table
            'sales_order_id' => ['required', 'exists:App\Models\Sales\SalesOrders,id'],

            // Carrier: optional, string, max 100 characters
            'carrier' => ['nullable', 'string', 'max:100'],

            // Tracking number: optional, string, max 100 characters
            'tracking_number' => ['nullable', 'string', 'max:100'],

            // Estimated delivery date: optional, must be a valid date
            'estimated_delivery_date' => ['nullable', 'date'],

            // Shipping address: required, string, max 500 characters
            'shipping_address' => ['required', 'string', 'max:500'],

            // Status: optional, string, max 50 characters (e.g., pending, shipped, delivered)
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
            'sales_order_id.required' => 'Please select a sales order.',
            'sales_order_id.exists' => 'The selected sales order does not exist.',
            'carrier.max' => 'Carrier name must not exceed 100 characters.',
            'tracking_number.max' => 'Tracking number must not exceed 100 characters.',
            'estimated_delivery_date.date' => 'Please enter a valid date.',
            'shipping_address.required' => 'The shipping address is required.',
            'shipping_address.max' => 'Shipping address must not exceed 500 characters.',
            'status.max' => 'Status must not exceed 50 characters.',
        ];
    }
}
