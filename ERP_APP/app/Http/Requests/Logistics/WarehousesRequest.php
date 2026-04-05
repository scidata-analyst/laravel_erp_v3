<?php

namespace App\Http\Requests\Logistics;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class WarehousesRequest extends FormRequest
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
                'type' => 'nullable|in:Standard,Cold Storage,Bonded',
                'status' => 'nullable|in:active,inactive',
                'search' => 'nullable|string'
            ];
        }

        return [
            'warehouse_name' => 'required_without:name|string|max:255|unique:warehouses,warehouse_name,' . $this->route('warehouse'),
            'name' => 'required_without:warehouse_name|string|max:255',
            'code' => 'required|string|max:10|unique:warehouses,code,' . $this->route('warehouse'),
            'type' => 'nullable|in:Standard,Cold Storage,Bonded',
            'location_address' => 'required_without:location|string|max:1000',
            'location' => 'required_without:location_address|string|max:1000',
            'manager' => 'nullable|string|max:255',
            'manager_id' => 'nullable|exists:employees,id',
            'capacity_units' => 'required_without:capacity|integer|min:1',
            'capacity' => 'required_without:capacity_units|integer|min:1',
            'status' => 'required|in:active,inactive,Active,Inactive',
            'contact_phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255'
        ];
    }

    public function messages(): array
    {
        return [
            'warehouse_name.required' => 'Warehouse name is required',
            'warehouse_name.unique' => 'Warehouse name already exists',
            'code.required' => 'Warehouse code is required',
            'code.unique' => 'Warehouse code already exists',
            'type.required' => 'Warehouse type is required',
            'type.in' => 'Warehouse type must be one of: Standard, Cold Storage, Bonded',
            'location_address.required' => 'Location address is required',
            'manager_id.exists' => 'Selected manager does not exist',
            'capacity_units.required' => 'Capacity is required',
            'capacity_units.integer' => 'Capacity must be an integer',
            'capacity_units.min' => 'Capacity must be at least 1',
            'status.required' => 'Status is required',
            'status.in' => 'Status must be one of: active, inactive'
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
