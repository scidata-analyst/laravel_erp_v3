<?php

namespace App\DTOs\HR;

class AttendanceDTO
{
    public readonly int $employee_id;
    public readonly string $date;
    public readonly ?string $check_in;
    public readonly ?string $check_out;
    public readonly ?string $status;
    public readonly ?string $notes;

    public function __construct(array $data)
    {
        $this->employee_id = (int)($data['employee_id'] ?? 0);
        $this->date = $data['date'] ?? $data['attendance_date'] ?? '';
        $this->check_in = $data['check_in'] ?? null;
        $this->check_out = $data['check_out'] ?? null;
        $status = strtolower((string)($data['status'] ?? 'present'));
        $this->status = match ($status) {
            'present' => 'present',
            'absent' => 'absent',
            'late' => 'late',
            'early leave', 'early_leave' => 'early_leave',
            default => 'present',
        };
        $this->notes = $data['notes'] ?? null;
    }
}