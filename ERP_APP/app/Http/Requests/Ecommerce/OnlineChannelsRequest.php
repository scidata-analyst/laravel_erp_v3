<?php

namespace App\Http\Requests\Ecommerce;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class OnlineChannelsRequest extends FormRequest
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
                'status' => 'nullable|in:active,inactive',
                'channel_name' => 'nullable|string',
                'search' => 'nullable|string'
            ];
        }

        return [
            'channel_name' => 'required|string|max:100|unique:online_channels,channel_name,' . $this->route('online_channel'),
            'api_key' => 'required|string|max:255',
            'api_secret' => 'required|string|max:255',
            'sync_frequency' => 'required|in:real-time,every-5-min,hourly,daily',
            'status' => 'required|in:active,inactive',
            'last_sync_status' => 'nullable|in:success,failed',
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
