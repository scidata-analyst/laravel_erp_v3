<?php

namespace App\Http\Requests\Ecommerce;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class PosRequest extends FormRequest
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
                'status' => 'nullable|in:active,inactive,maintenance',
            ];
        }

        return [
            'terminal_name' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'status' => 'required|in:active,inactive,maintenance,Online,Offline,Closed',
            'last_sync' => 'nullable|date',
            'last_sync_date' => 'nullable|date',
            'cash_drawer_balance' => 'nullable|numeric|min:0',
            'opening_balance' => 'nullable|numeric|min:0',
            'current_user_id' => 'nullable|exists:users,id',
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
