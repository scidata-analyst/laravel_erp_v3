<?php

namespace App\Http\Resources\HR;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PayrollResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'employee' => new EmployeesResource($this->whenLoaded('employee')),
            'employee_id' => $this->employee_id,
            'employee_name' => $this->employee?->full_name,
            'pay_period' => $this->pay_period,
            'period_start' => $this->period_start,
            'period_end' => $this->period_end,
            'basic_salary' => $this->basic_salary,
            'salary' => $this->net_salary,
            'overtime_hours' => $this->overtime_hours,
            'overtime_rate' => $this->overtime_rate,
            'bonus' => $this->bonus,
            'deductions' => $this->deductions,
            'net_pay' => $this->net_pay,
            'net_salary' => $this->net_salary,
            'payment_date' => $this->payment_date,
            'pay_date' => $this->payment_date,
            'payment_method' => $this->payment_method,
            'status' => ucfirst((string) $this->status),
            'created_at' => $this->created_at->toDateTimeString(),
        ];
    }
}
