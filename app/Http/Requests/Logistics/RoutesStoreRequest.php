<?php

namespace App\Http\Requests\Logistics;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for creating a new Route.
 */
class RoutesStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'route_name' => ['required', 'string', 'max:255'],
            'zone_area' => ['required', 'string', 'max:100'],
            'driver_name' => ['required', 'string', 'max:100'],
            'vehicle_id' => ['nullable', 'integer'],
            'number_of_stops' => ['nullable', 'integer', 'min:0'],
            'route_description' => ['nullable', 'string'],
            'status' => ['nullable', 'string', 'max:50'],
        ];
    }

    public function messages(): array
    {
        return [
            'route_name.required' => 'The route name is required.',
            'zone_area.required' => 'The zone area is required.',
            'driver_name.required' => 'The driver name is required.',
            'number_of_stops.integer' => 'Number of stops must be an integer.',
        ];
    }
}