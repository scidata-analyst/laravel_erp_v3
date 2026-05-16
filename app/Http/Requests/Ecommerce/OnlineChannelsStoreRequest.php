<?php

namespace App\Http\Requests\Ecommerce;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for creating a new Online Channel.
 */
class OnlineChannelsStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'channel_name' => ['required', 'string', 'max:255'],
            'platform' => ['required', 'string', 'max:50'],
            'api_store_url' => ['required', 'url', 'max:255'],
            'api_key' => ['required', 'string', 'max:500'],
            'sync_frequency' => ['required', 'string', 'max:50'],
            'status' => ['nullable', 'string', 'max:50'],
        ];
    }

    public function messages(): array
    {
        return [
            'channel_name.required' => 'The channel name is required.',
            'platform.required' => 'The platform is required.',
            'api_store_url.required' => 'The API store URL is required.',
            'api_store_url.url' => 'Please enter a valid URL.',
            'api_key.required' => 'The API key is required.',
            'sync_frequency.required' => 'The sync frequency is required.',
        ];
    }
}