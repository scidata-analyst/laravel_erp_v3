<?php

namespace App\Http\Requests\UsersRoles;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for creating a new User.
 */
class UserStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
            'role_id' => ['required', 'integer', 'exists:roles,id'],
            'status' => ['nullable', 'string', 'max:50'],
        ];
    }

    public function messages(): array
    {
        return [
            'user_name.required' => 'The name field is required.',
            'email.required' => 'The email field is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'The email has already been taken.',
            'password.required' => 'The password field is required.',
            'password.min' => 'Password must be at least 8 characters.',
            'role_id.required' => 'The role field is required.',
            'role_id.exists' => 'The selected role is invalid.',
        ];
    }

    public function attributes(): array
    {
        return [
            'user_name' => 'name',
        ];
    }
}