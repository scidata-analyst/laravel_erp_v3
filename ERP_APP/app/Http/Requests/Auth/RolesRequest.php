<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RolesRequest extends FormRequest
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
                'status' => 'nullable|string|in:Active,Inactive',
                'search' => 'nullable|string'
            ];
        }

        return [
            'role_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'permissions' => 'nullable|array',
            'status' => 'nullable|string|in:Active,Inactive',
        ];
    }
}
