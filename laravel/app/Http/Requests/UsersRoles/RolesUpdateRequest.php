<?php

namespace App\Http\Requests\UsersRoles;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for updating an existing Role.
 */
class RolesUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $roleId = $this->route('role');
        return [
            'role_name' => ['sometimes', 'string', 'max:100', 'unique:roles,role_name,' . $roleId],
            'description' => ['nullable', 'string', 'max:255'],
            'status' => ['nullable', 'string', 'max:50'],
        ];
    }

    public function messages(): array
    {
        return [
            'role_name.unique' => 'The role name must be unique.',
        ];
    }
}