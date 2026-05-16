<?php

namespace App\Http\Requests\UsersRoles;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for creating a new Role.
 */
class RolesStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'role_name' => ['required', 'string', 'max:100', 'unique:roles,role_name'],
            'description' => ['nullable', 'string', 'max:255'],
            'status' => ['nullable', 'string', 'max:50'],
        ];
    }

    public function messages(): array
    {
        return [
            'role_name.required' => 'The role name is required.',
            'role_name.unique' => 'The role name must be unique.',
        ];
    }
}