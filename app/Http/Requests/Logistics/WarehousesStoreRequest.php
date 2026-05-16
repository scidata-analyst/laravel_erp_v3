<?php

namespace App\Http\Requests\Logistics;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for creating a new Warehouse.
 */
class WarehousesStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'warehouse_name' => ['required', 'string', 'max:255'],
            'warehouse_code' => ['required', 'string', 'max:50', 'unique:warehouses,warehouse_code'],
            'warehouse_type' => ['required', 'string', 'max:50'],
            'location_address' => ['required', 'string'],
            'manager_id' => ['nullable', 'integer'],
            'capacity_units' => ['required', 'integer', 'min:0'],
            'status' => ['nullable', 'string', 'max:50'],
        ];
    }

    public function messages(): array
    {
        return [
            'warehouse_name.required' => 'The warehouse name is required.',
            'warehouse_code.required' => 'The warehouse code is required.',
            'warehouse_code.unique' => 'The warehouse code must be unique.',
            'warehouse_type.required' => 'The warehouse type is required.',
            'location_address.required' => 'The location address is required.',
            'capacity_units.required' => 'The capacity is required.',
            'capacity_units.integer' => 'Capacity must be an integer.',
        ];
    }
}