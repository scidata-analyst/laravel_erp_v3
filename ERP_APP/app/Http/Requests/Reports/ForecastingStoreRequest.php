<?php

namespace App\Http\Requests\Reports;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for creating a new Forecasting record.
 */
class ForecastingStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'forecast_name' => ['required', 'string', 'max:255'],
            'forecast_type' => ['required', 'string', 'max:50'],
            'period_from' => ['required', 'date'],
            'period_to' => ['required', 'date', 'after:period_from'],
            'model' => ['required', 'string', 'max:50'],
            'accuracy_percentage' => ['nullable', 'numeric', 'min:0', 'max:100'],
            'status' => ['nullable', 'string', 'max:50'],
        ];
    }

    public function messages(): array
    {
        return [
            'forecast_name.required' => 'The forecast name is required.',
            'forecast_type.required' => 'The forecast type is required.',
            'period_from.required' => 'The period from date is required.',
            'period_to.required' => 'The period to date is required.',
            'period_to.after' => 'Period to must be after period from.',
            'model.required' => 'The forecasting model is required.',
            'accuracy_percentage.max' => 'Accuracy cannot exceed 100%.',
        ];
    }
}