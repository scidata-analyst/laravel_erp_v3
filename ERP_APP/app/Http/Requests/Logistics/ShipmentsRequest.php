<?php

namespace App\Http\Requests\Logistics;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class ShipmentsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        if ($this->isMethod('get')) {
            return [
                'per_page' => 'nullable|integer|min:1|max:100',
                'status' => 'nullable|in:Pending,In Transit,Delivered,Returned,Cancelled',
                'carrier' => 'nullable|in:DHL,FedEx,UPS,Local Courier',
                'search' => 'nullable|string'
            ];
        }

        return [
            'shipment_number' => 'required|string|max:50|unique:shipments,shipment_number,' . $this->route('shipment'),
            'sales_order_id' => 'nullable|exists:sales_orders,id',
            'customer' => 'nullable|string|max:255',
            'carrier' => 'required|string|max:255',
            'tracking_number' => 'nullable|string|max:100',
            'origin' => 'nullable|string|max:255',
            'destination' => 'nullable|string|max:1000',
            'shipped_date' => 'nullable|date',
            'estimated_arrival' => 'nullable|date',
            'est_delivery_date' => 'nullable|date',
            'actual_delivery_date' => 'nullable|date',
            'status' => 'required|in:Pending,Preparing,Dispatched,In Transit,Delivered,Returned,Cancelled,Failed',
            'shipping_address' => 'nullable|string|max:1000',
            'cost' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string|max:1000'
        ];
    }

    public function messages(): array
    {
        return [
            'shipment_number.required' => 'Shipment number is required',
            'shipment_number.unique' => 'Shipment number already exists',
            'sales_order_id.required' => 'Sales order is required',
            'sales_order_id.exists' => 'Selected sales order does not exist',
            'customer.required' => 'Customer is required',
            'carrier.required' => 'Carrier is required',
            'carrier.in' => 'Carrier must be one of: DHL, FedEx, UPS, Local Courier',
            'est_delivery_date.required' => 'Estimated delivery date is required',
            'status.required' => 'Status is required',
            'status.in' => 'Status must be one of: Pending, In Transit, Delivered, Returned, Cancelled',
            'shipping_address.required' => 'Shipping address is required',
            'cost.numeric' => 'Cost must be a number',
            'cost.min' => 'Cost must be at least 0'
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Validation failed',
            'errors' => $validator->errors()
        ], 422));
    }
}
