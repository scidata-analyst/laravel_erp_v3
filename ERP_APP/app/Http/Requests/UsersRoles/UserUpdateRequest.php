<?php

namespace App\Http\Requests\UsersRoles;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for updating an existing User.
 */
class UserUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $userId = $this->route('id') ?? $this->route('user');
        return [
            'user_name' => ['sometimes', 'string', 'max:255'],
            'email' => ['sometimes', 'email', 'max:255', 'unique:users,email,' . $userId],
            'password' => ['nullable', 'string', 'min:8'],
            'role_id' => ['sometimes', 'integer', 'exists:roles,id'],
            'department' => ['nullable', 'string', 'max:100'],
            'is_active' => ['nullable', 'string', 'max:50'],
        ];
    }

    public function messages(): array
    {
        return [
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'The email has already been taken.',
            'password.min' => 'Password must be at least 8 characters.',
            'role_id.exists' => 'The selected role is invalid.',
        ];
    }
}