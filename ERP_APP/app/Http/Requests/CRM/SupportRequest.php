<?php

namespace App\Http\Requests\CRM;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class SupportRequest extends FormRequest
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
                'customer_id' => 'nullable|exists:customers,id',
                'status' => 'nullable|in:open,pending,resolved,closed',
                'category' => 'nullable|in:technical,billing,general,feedback'
            ];
        }

        return [
            'ticket_number' => 'required|string|max:50|unique:supports,ticket_number,' . $this->route('support'),
            'customer_id' => 'nullable|exists:customers,id',
            'lead_id' => 'nullable|exists:leads,id',
            'subject' => 'required|string|max:255',
            'description' => 'required|string|max:2000',
            'priority' => 'required|in:low,medium,high,urgent',
            'status' => 'required|in:open,pending,resolved,closed',
            'category' => 'required|in:technical,billing,general,feedback',
            'assigned_to' => 'nullable|exists:users,id',
            'resolution' => 'nullable|string|max:2000',
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Validation failed',
            'errors' => $validator->errors()
        ], 422));
    }
}
