<?php

namespace App\Http\Requests\Logistics;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for validating Warehouse data.
 *
 * Validates fields based on the Warehouses model fillable attributes:
 * - warehouse_name: required, string, max 255
 * - warehouse_code: required, string, max 50, unique in warehouses table
 * - warehouse_type: nullable, string, max 50
 * - location_address: nullable, string, max 500
 * - manager_id: nullable, exists in users table (foreign key relationship)
 * - capacity_units: nullable, integer, min 0
 * - status: nullable, string, max 50
 */
class WarehousesRequest extends FormRequest
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
        // Get the warehouse ID for unique validation on updates
        $warehouseId = $this->route('warehouse');

        return [
            // Warehouse name: required, string, max 255 characters
            'warehouse_name' => ['required', 'string', 'max:255'],

            // Warehouse code: required, string, max 50 characters, unique in warehouses
            'warehouse_code' => [
                'required',
                'string',
                'max:50',
                "unique:warehouses,warehouse_code,{$warehouseId},id",
            ],

            // Warehouse type: optional, string, max 50 characters (e.g., main, distribution, retail)
            'warehouse_type' => ['nullable', 'string', 'max:50'],

            // Location address: optional, string, max 500 characters
            'location_address' => ['nullable', 'string', 'max:500'],

            // Manager: optional, must exist in users table
            'manager_id' => ['nullable', 'exists:App\Models\UsersRoles\User,id'],

            // Capacity units: optional, integer, must be 0 or greater
            'capacity_units' => ['nullable', 'integer', 'min:0'],

            // Status: optional, string, max 50 characters (e.g., active, inactive)
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
            'warehouse_name.required' => 'The warehouse name is required.',
            'warehouse_name.max' => 'Warehouse name must not exceed 255 characters.',
            'warehouse_code.required' => 'The warehouse code is required.',
            'warehouse_code.max' => 'Warehouse code must not exceed 50 characters.',
            'warehouse_code.unique' => 'This warehouse code is already in use.',
            'warehouse_type.max' => 'Warehouse type must not exceed 50 characters.',
            'location_address.max' => 'Location address must not exceed 500 characters.',
            'manager_id.exists' => 'The selected manager does not exist.',
            'capacity_units.integer' => 'Capacity units must be an integer.',
            'capacity_units.min' => 'Capacity units must be at least 0.',
            'status.max' => 'Status must not exceed 50 characters.',
        ];
    }
}
