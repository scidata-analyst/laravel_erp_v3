<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        if ($this->isMethod('get')) {
            return [
                'per_page' => 'nullable|integer|min:1|max:100',
                'status' => 'nullable|string|in:Active,Inactive,Suspended',
                'role_id' => 'nullable|integer|exists:roles,id',
                'department_id' => 'nullable|integer|exists:departments,id',
                'search' => 'nullable|string'
            ];
        }

        $userId = $this->route('user');

        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . ($userId ?? 'NULL') . ',id',
            'password' => $this->isMethod('POST') ? 'required|string|min:8' : 'nullable|string|min:8',
            'role_id' => 'nullable|integer|exists:roles,id',
            'department_id' => 'nullable|integer|exists:departments,id',
            'status' => 'nullable|string|in:Active,Inactive,Suspended',
        ];
    }
}
