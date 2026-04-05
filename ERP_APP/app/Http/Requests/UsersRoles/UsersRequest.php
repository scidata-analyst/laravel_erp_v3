<?php

namespace App\Http\Requests\UsersRoles;

use App\Enums\UserStatus;
use App\Traits\Validation\ValidationResponseTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class UsersRequest extends FormRequest
{
    use ValidationResponseTrait;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->user?->id,
            'password' => $this->isMethod('POST') ? 'required|string|min:8|confirmed' : 'nullable|string|min:8|confirmed',
            'role_id' => 'required|exists:roles,id',
            'department_id' => 'nullable|exists:departments,id',
            'status' => ['required', new Enum(UserStatus::class)],
        ];
    }

    public function messages(): array
    {
        return [
            'email.unique' => 'This email is already taken.',
            'password.confirmed' => 'Password confirmation does not match.',
            'role_id.exists' => 'Selected role does not exist.',
            'status.Illuminate\Validation\Rules\Enum' => 'Invalid status selected.',
        ];
    }

    public function attributes(): array
    {
        return [
            'role_id' => 'role',
            'profile_picture' => 'profile picture'
        ];
    }
}
