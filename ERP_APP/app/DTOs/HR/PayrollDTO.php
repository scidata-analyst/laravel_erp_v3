<?php

namespace App\DTOs\HR;

class PayrollDTO
{
    public function __construct(
        public readonly int $employee_id,
        public readonly string $period_start,
        public readonly string $period_end,
        public readonly float $basic_salary,
        public readonly float $deductions = 0,
        public readonly float $net_pay = 0,
        public readonly ?string $pay_date = null,
        public readonly ?string $payment_method = null,
        public readonly ?string $status = 'draft',
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            employee_id: (int) $data['employee_id'],
            period_start: $data['period_start'],
            period_end: $data['period_end'],
            basic_salary: (float) $data['basic_salary'],
            deductions: (float) ($data['deductions'] ?? 0),
            net_pay: (float) ($data['net_pay'] ?? $data['net_salary']),
            pay_date: $data['pay_date'] ?? $data['payment_date'] ?? $data['period_end'] ?? null,
            payment_method: $data['payment_method'] ?? 'Bank Transfer',
            status: strtolower((string) ($data['status'] ?? 'draft')),
        );
    }

    public function toArray(): array
    {
        return [
            'employee_id' => $this->employee_id,
            'period_start' => $this->period_start,
            'period_end' => $this->period_end,
            'basic_salary' => $this->basic_salary,
            'deductions' => $this->deductions,
            'net_pay' => $this->net_pay,
            'pay_date' => $this->pay_date,
            'payment_method' => $this->payment_method,
            'status' => $this->status,
        ];
    }
}
