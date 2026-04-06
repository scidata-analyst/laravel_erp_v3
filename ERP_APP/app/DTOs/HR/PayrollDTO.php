<?php

namespace App\DTOs\HR;

class PayrollDTO
{
    public readonly int $employee_id;
    public readonly string $period_start;
    public readonly string $period_end;
    public readonly float $basic_salary;
    public readonly float $deductions;
    public readonly float $net_pay;
    public readonly ?string $pay_date;
    public readonly ?string $payment_method;
    public readonly ?string $status;

    public function __construct(array $data)
    {
        $this->employee_id = (int)($data['employee_id']);
        $this->period_start = $data['period_start'];
        $this->period_end = $data['period_end'];
        $this->basic_salary = (float)($data['basic_salary']);
        $this->deductions = isset($data['deductions']) ? (float)$data['deductions'] : 0;
        $this->net_pay = isset($data['net_pay']) ? (float)$data['net_pay'] : (isset($data['net_salary']) ? (float)$data['net_salary'] : 0);
        $this->pay_date = $data['pay_date'] ?? $data['payment_date'] ?? $data['period_end'] ?? null;
        $this->payment_method = $data['payment_method'] ?? 'Bank Transfer';
        $this->status = strtolower((string)($data['status'] ?? 'draft'));
    }
}