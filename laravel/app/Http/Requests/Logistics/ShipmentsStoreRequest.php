<?php

namespace App\Http\Requests\Logistics;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for creating a new Shipment.
 */
class ShipmentsStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'sales_order_id' => ['required', 'integer', 'exists:sales_orders,id'],
            'carrier' => ['required', 'string', 'max:100'],
            'tracking_number' => ['nullable', 'string', 'max:100'],
            'estimated_delivery_date' => ['nullable', 'date'],
            'shipping_address' => ['required', 'string'],
            'status' => ['nullable', 'string', 'max:50'],
        ];
    }

    public function messages(): array
    {
        return [
            'sales_order_id.required' => 'The sales order is required.',
            'sales_order_id.exists' => 'The selected sales order is invalid.',
            'carrier.required' => 'The carrier is required.',
            'shipping_address.required' => 'The shipping address is required.',
        ];
    }
}