<?php

namespace App\Http\Requests\Reports;

use Illuminate\Foundation\Http\FormRequest;

class ForecastingRequest extends FormRequest
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
                'forecast_type' => 'nullable|string|in:Sales,Inventory,Financial',
                'status' => 'nullable|string|in:Pending,Completed,Failed',
                'search' => 'nullable|string'
            ];
        }

        return [
            'forecast_name' => 'required_without:name|string|max:255',
            'name' => 'required_without:forecast_name|string|max:255',
            'forecast_type' => 'required_without:model_type|string|in:Sales,Inventory,Financial,Revenue,Expense',
            'model_type' => 'required_without:forecast_type|string|in:Sales,Inventory,Financial,Revenue,Expense',
            'start_date' => 'required_without:period_from|date',
            'period_from' => 'required_without:start_date|date',
            'end_date' => 'required_without:period_to|date|after_or_equal:start_date',
            'period_to' => 'required_without:end_date|date|after_or_equal:period_from',
            'data_model' => 'nullable|string',
            'data_source' => 'nullable|string',
            'status' => 'nullable|string|in:Pending,Completed,Failed,Active,Archived',
        ];
    }
}
