<?php

namespace App\Http\Requests\Logistics;

use Illuminate\Foundation\Http\FormRequest;

class FleetRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'vehicle_name' => 'required|string|max:255',
            'vehicle_number' => 'required|string|unique:fleets,vehicle_number,' . ($this->route('fleet') ?? 'NULL') . ',id',
            'vehicle_type' => 'required|string|in:Truck,Van,Car,Motorcycle',
            'capacity' => 'nullable|numeric|min:0',
            'status' => 'nullable|string|in:Available,Busy,Maintenance,Repair',
        ];
    }
}
