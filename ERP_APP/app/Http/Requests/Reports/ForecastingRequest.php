<?php

namespace App\Http\Requests\Reports;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for validating Forecasting data.
 *
 * Validates fields based on the Forecasting model fillable attributes:
 * - forecast_name: required, string, max 100
 * - forecast_type: required, string, max 50
 * - period_from: required, date
 * - period_to: required, date, must be after period_from
 * - model: nullable, string, max 50
 * - accuracy_percentage: nullable, numeric, between 0 and 100
 * - status: nullable, string, max 50
 */
class ForecastingRequest extends FormRequest
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
        // Get the forecast ID for unique validation on updates
        $forecastId = $this->route('forecasting');

        return [
            // Forecast name: required, string, max 100 characters
            'forecast_name' => ['required', 'string', 'max:100'],

            // Forecast type: required, string, max 50 characters (e.g., sales, demand)
            'forecast_type' => ['required', 'string', 'max:50'],

            // Period from: required, must be a valid date
            'period_from' => ['required', 'date'],

            // Period to: required, must be a valid date after period_from
            'period_to' => ['required', 'date', 'after:period_from'],

            // Model: optional, string, max 50 characters (e.g., linear_regression, moving_average)
            'model' => ['nullable', 'string', 'max:50'],

            // Accuracy percentage: optional, numeric, between 0 and 100
            'accuracy_percentage' => ['nullable', 'numeric', 'min:0', 'max:100'],

            // Status: optional, string, max 50 characters (e.g., draft, active, completed)
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
            'forecast_name.required' => 'The forecast name is required.',
            'forecast_name.max' => 'Forecast name must not exceed 100 characters.',
            'forecast_type.required' => 'The forecast type is required.',
            'forecast_type.max' => 'Forecast type must not exceed 50 characters.',
            'period_from.required' => 'The period from date is required.',
            'period_from.date' => 'Please enter a valid date.',
            'period_to.required' => 'The period to date is required.',
            'period_to.date' => 'Please enter a valid date.',
            'period_to.after' => 'Period to date must be after the period from date.',
            'model.max' => 'Model must not exceed 50 characters.',
            'accuracy_percentage.numeric' => 'Accuracy percentage must be a numeric value.',
            'accuracy_percentage.min' => 'Accuracy percentage must be at least 0.',
            'accuracy_percentage.max' => 'Accuracy percentage must not exceed 100.',
            'status.max' => 'Status must not exceed 50 characters.',
        ];
    }
}
