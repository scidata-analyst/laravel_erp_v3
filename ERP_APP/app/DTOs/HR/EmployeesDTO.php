<?php

namespace App\DTOs\HR;

class EmployeesDTO
{
    public function __construct(
        public readonly string $full_name,
        public readonly ?string $employee_code = null,
        public readonly ?string $position = null,
        public readonly ?string $department = null,
        public readonly ?float $basic_salary = null,
        public readonly ?string $join_date = null,
        public readonly ?string $contract_type = null,
        public readonly ?string $email = null,
        public readonly ?string $phone = null,
        public readonly ?string $address = null,
        public readonly ?string $status = 'active',
        public readonly ?int $manager_id = null,
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            full_name: $data['full_name'] ?? $data['name'] ?? trim(($data['first_name'] ?? '') . ' ' . ($data['last_name'] ?? '')),
            employee_code: $data['employee_code'] ?? $data['employee_id'] ?? null,
            position: $data['position'] ?? $data['job_title'] ?? null,
            department: $data['department'] ?? null,
            basic_salary: isset($data['basic_salary']) ? (float) $data['basic_salary'] : (isset($data['salary']) ? (float) $data['salary'] : null),
            join_date: $data['join_date'] ?? $data['hire_date'] ?? null,
            contract_type: $data['contract_type'] ?? null,
            email: $data['email'] ?? null,
            phone: $data['phone'] ?? null,
            address: $data['address'] ?? null,
            status: $data['status'] ?? 'active',
            manager_id: isset($data['manager_id']) ? (int) $data['manager_id'] : null,
        );
    }

    public function toArray(): array
    {
        return [
            'full_name' => $this->full_name,
            'employee_code' => $this->employee_code,
            'position' => $this->position,
            'department' => $this->department,
            'basic_salary' => $this->basic_salary,
            'join_date' => $this->join_date,
            'contract_type' => $this->contract_type,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'status' => $this->status,
            'manager_id' => $this->manager_id,
        ];
    }
}
