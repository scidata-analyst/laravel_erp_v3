<?php

namespace App\Http\Requests\UsersRoles;

use App\Traits\Validation\ValidationResponseTrait;
use Illuminate\Foundation\Http\FormRequest;

class RolesRequest extends FormRequest
{
    use ValidationResponseTrait;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'role_name' => 'nullable|string|max:100|unique:roles,role_name,' . ($this->route('id') ?? 'NULL'),
            'name' => 'nullable|string|max:100',
            'description' => 'required|string|max:500',
            'permissions' => 'nullable|array',
            'permissions.*' => 'nullable',
            'is_system_role' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'role_name.required' => 'The role name is required.',
            'role_name.unique' => 'This role name already exists.',
            'description.required' => 'A description is required.',
        ];
    }
}
