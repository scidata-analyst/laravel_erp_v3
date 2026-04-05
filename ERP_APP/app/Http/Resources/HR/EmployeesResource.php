<?php

namespace App\Http\Resources\HR;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeesResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'full_name' => $this->full_name,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'employee_id' => $this->employee_id,
            'employee_code' => $this->employee_code,
            'position' => $this->position,
            'department' => $this->department,
            'designation' => $this->designation,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'salary' => $this->salary,
            'basic_salary' => $this->basic_salary,
            'join_date' => $this->join_date?->toDateString(),
            'contract_type' => $this->contract_type,
            'manager_id' => $this->manager_id,
            'manager_name' => $this->whenLoaded('manager', fn () => $this->manager?->full_name),
            'status' => $this->status,
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}
