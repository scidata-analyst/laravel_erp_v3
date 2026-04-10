<?php

namespace App\Http\Requests\Logistics;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for validating Route data.
 *
 * Validates fields based on the Routes model fillable attributes:
 * - route_name: required, string, max 100
 * - zone_area: nullable, string, max 100
 * - driver_name: nullable, string, max 100
 * - vehicle_id: nullable, string, max 50
 * - number_of_stops: nullable, integer, min 0
 * - route_description: nullable, string, max 500
 * - status: nullable, string, max 50
 */
class RoutesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // Get the route ID for unique validation on updates
        $routeId = $this->route('route');

        return [
            // Route name: required, string, max 100 characters
            'route_name' => ['required', 'string', 'max:100'],

            // Zone/area: optional, string, max 100 characters
            'zone_area' => ['nullable', 'string', 'max:100'],

            // Driver name: optional, string, max 100 characters
            'driver_name' => ['nullable', 'string', 'max:100'],

            // Vehicle ID: optional, string, max 50 characters
            'vehicle_id' => ['nullable', 'string', 'max:50'],

            // Number of stops: optional, integer, must be 0 or greater
            'number_of_stops' => ['nullable', 'integer', 'min:0'],

            // Route description: optional, string, max 500 characters
            'route_description' => ['nullable', 'string', 'max:500'],

            // Status: optional, string, max 50 characters (e.g., active, inactive)
            'status' => ['nullable', 'string', 'max:50'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'route_name.required' => 'The route name is required.',
            'route_name.max' => 'Route name must not exceed 100 characters.',
            'zone_area.max' => 'Zone/area must not exceed 100 characters.',
            'driver_name.max' => 'Driver name must not exceed 100 characters.',
            'vehicle_id.max' => 'Vehicle ID must not exceed 50 characters.',
            'number_of_stops.integer' => 'Number of stops must be an integer.',
            'number_of_stops.min' => 'Number of stops must be at least 0.',
            'route_description.max' => 'Route description must not exceed 500 characters.',
            'status.max' => 'Status must not exceed 50 characters.',
        ];
    }
}
