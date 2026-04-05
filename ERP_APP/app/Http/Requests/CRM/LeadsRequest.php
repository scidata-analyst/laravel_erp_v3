<?php

namespace App\Http\Requests\CRM;

use Illuminate\Foundation\Http\FormRequest;

class LeadsRequest extends FormRequest
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
                'status' => 'nullable|string|in:New,Contacted,Qualified,Lost',
                'search' => 'nullable|string'
            ];
        }

        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:leads,email,' . $this->route('lead'),
            'phone' => 'nullable|string',
            'company' => 'nullable|string',
            'source' => 'nullable|string',
            'status' => 'nullable|string|in:New,Contacted,Qualified,Lost',
        ];
    }
}
