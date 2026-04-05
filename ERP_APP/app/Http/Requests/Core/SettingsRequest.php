<?php

namespace App\Http\Requests\Core;

use Illuminate\Foundation\Http\FormRequest;

class SettingsRequest extends FormRequest
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
                'category' => 'nullable|string',
                'search' => 'nullable|string'
            ];
        }

        return [
            'setting_key' => 'required_without:key|string|max:255',
            'key' => 'required_without:setting_key|string|max:255',
            'setting_value' => 'required_without:value',
            'value' => 'required_without:setting_value',
            'setting_type' => 'nullable|string|in:string,number,boolean,array,json',
            'category' => 'nullable|string',
            'description' => 'nullable|string',
            'is_system' => 'nullable|boolean',
        ];
    }
}
