<?php

namespace App\Http\Requests\UsersRoles;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for validating Role data.
 *
 * Validates fields based on the Roles model fillable attributes:
 * - role_name: required, string, max 100, unique in roles table
 * - description: nullable, string, max 500
 * - status: nullable, string, max 50
 */
class RolesRequest extends FormRequest
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
        // Get the role ID for unique validation on updates
        $roleId = $this->route('role');

        return [
            // Role name: required, string, max 100 characters, unique in roles
            'role_name' => [
                'required',
                'string',
                'max:100',
                "unique:roles,role_name,{$roleId},id",
            ],

            // Description: optional, string, max 500 characters
            'description' => ['nullable', 'string', 'max:500'],

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
            'role_name.required' => 'The role name is required.',
            'role_name.max' => 'Role name must not exceed 100 characters.',
            'role_name.unique' => 'This role name is already in use.',
            'description.max' => 'Description must not exceed 500 characters.',
            'status.max' => 'Status must not exceed 50 characters.',
        ];
    }
}
