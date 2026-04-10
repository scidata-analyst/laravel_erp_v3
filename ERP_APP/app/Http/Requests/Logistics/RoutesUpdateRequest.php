<?php

namespace App\Http\Requests\Logistics;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for updating an existing Route.
 */
class RoutesUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'route_name' => ['sometimes', 'string', 'max:255'],
            'zone_area' => ['sometimes', 'string', 'max:100'],
            'driver_name' => ['sometimes', 'string', 'max:100'],
            'vehicle_id' => ['nullable', 'integer'],
            'number_of_stops' => ['nullable', 'integer', 'min:0'],
            'route_description' => ['nullable', 'string'],
            'status' => ['nullable', 'string', 'max:50'],
        ];
    }

    public function messages(): array
    {
        return [
            'number_of_stops.integer' => 'Number of stops must be an integer.',
        ];
    }
}