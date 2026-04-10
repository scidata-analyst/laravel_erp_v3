<?php

namespace App\Http\Requests\Logistics;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for updating an existing Warehouse.
 */
class WarehousesUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $warehouseId = $this->route('warehouse');
        return [
            'warehouse_name' => ['sometimes', 'string', 'max:255'],
            'warehouse_code' => ['sometimes', 'string', 'max:50', 'unique:warehouses,warehouse_code,' . $warehouseId],
            'warehouse_type' => ['sometimes', 'string', 'max:50'],
            'location_address' => ['sometimes', 'string'],
            'manager_id' => ['nullable', 'integer'],
            'capacity_units' => ['sometimes', 'integer', 'min:0'],
            'status' => ['nullable', 'string', 'max:50'],
        ];
    }

    public function messages(): array
    {
        return [
            'warehouse_code.unique' => 'The warehouse code must be unique.',
            'capacity_units.integer' => 'Capacity must be an integer.',
        ];
    }
}