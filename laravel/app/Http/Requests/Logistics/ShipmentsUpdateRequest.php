<?php

namespace App\Http\Requests\Logistics;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for updating an existing Shipment.
 */
class ShipmentsUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'sales_order_id' => ['sometimes', 'integer', 'exists:sales_orders,id'],
            'carrier' => ['sometimes', 'string', 'max:100'],
            'tracking_number' => ['nullable', 'string', 'max:100'],
            'estimated_delivery_date' => ['nullable', 'date'],
            'shipping_address' => ['sometimes', 'string'],
            'status' => ['nullable', 'string', 'max:50'],
        ];
    }

    public function messages(): array
    {
        return [
            'sales_order_id.exists' => 'The selected sales order is invalid.',
        ];
    }
}