<?php

namespace App\Http\Requests\Reports;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for updating an existing Forecasting record.
 */
class ForecastingUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'forecast_name' => ['sometimes', 'string', 'max:255'],
            'forecast_type' => ['sometimes', 'string', 'max:50'],
            'period_from' => ['sometimes', 'date'],
            'period_to' => ['sometimes', 'date'],
            'model' => ['sometimes', 'string', 'max:50'],
            'accuracy_percentage' => ['nullable', 'numeric', 'min:0', 'max:100'],
            'status' => ['nullable', 'string', 'max:50'],
        ];
    }

    public function messages(): array
    {
        return [
            'period_to.after' => 'Period to must be after period from.',
            'accuracy_percentage.max' => 'Accuracy cannot exceed 100%.',
        ];
    }
}