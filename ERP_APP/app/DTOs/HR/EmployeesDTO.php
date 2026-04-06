<?php

namespace App\DTOs\HR;

class EmployeesDTO
{
    public readonly string $full_name;
    public readonly ?string $employee_code;
    public readonly ?string $position;
    public readonly ?string $department;
    public readonly ?float $basic_salary;
    public readonly ?string $join_date;
    public readonly ?string $contract_type;
    public readonly ?string $email;
    public readonly ?string $phone;
    public readonly ?string $address;
    public readonly ?string $status;
    public readonly ?int $manager_id;

    public function __construct(array $data)
    {
        $this->full_name = (string)($data['full_name'] ?? $data['name'] ?? trim(($data['first_name'] ?? '') . ' ' . ($data['last_name'] ?? '')));
        $this->employee_code = $data['employee_code'] ?? $data['employee_id'] ?? null;
        $this->position = $data['position'] ?? $data['job_title'] ?? null;
        $this->department = $data['department'] ?? null;
        $this->basic_salary = isset($data['basic_salary']) ? (float)$data['basic_salary'] : (isset($data['salary']) ? (float)$data['salary'] : null);
        $this->join_date = $data['join_date'] ?? $data['hire_date'] ?? null;
        $this->contract_type = $data['contract_type'] ?? null;
        $this->email = $data['email'] ?? null;
        $this->phone = $data['phone'] ?? null;
        $this->address = $data['address'] ?? null;
        $this->status = $data['status'] ?? 'active';
        $this->manager_id = isset($data['manager_id']) ? (int)$data['manager_id'] : null;
    }
}