<?php

namespace App\Http\Requests\Ecommerce;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for updating an existing Online Channel.
 */
class OnlineChannelsUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'channel_name' => ['sometimes', 'string', 'max:255'],
            'platform' => ['sometimes', 'string', 'max:50'],
            'api_store_url' => ['sometimes', 'url', 'max:255'],
            'api_key' => ['sometimes', 'string', 'max:500'],
            'sync_frequency' => ['sometimes', 'string', 'max:50'],
            'status' => ['nullable', 'string', 'max:50'],
        ];
    }

    public function messages(): array
    {
        return [
            'api_store_url.url' => 'Please enter a valid URL.',
        ];
    }
}