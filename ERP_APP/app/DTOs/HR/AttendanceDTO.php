<?php

namespace App\DTOs\HR;

class AttendanceDTO
{
    public function __construct(
        public readonly int $employee_id,
        public readonly string $date,
        public readonly ?string $check_in = null,
        public readonly ?string $check_out = null,
        public readonly ?string $status = 'present', // present, absent, late, leave
        public readonly ?string $notes = null
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            employee_id: (int) $data['employee_id'],
            date: $data['date'] ?? $data['attendance_date'],
            check_in: $data['check_in'] ?? null,
            check_out: $data['check_out'] ?? null,
            status: match (strtolower((string) ($data['status'] ?? 'present'))) {
                'present' => 'present',
                'absent' => 'absent',
                'late' => 'late',
                'early leave' => 'early_leave',
                'early_leave' => 'early_leave',
                default => 'present',
            },
            notes: $data['notes'] ?? null
        );
    }

    public function toArray(): array
    {
        return [
            'employee_id' => $this->employee_id,
            'date' => $this->date,
            'attendance_date' => $this->date,
            'check_in' => $this->check_in,
            'check_out' => $this->check_out,
            'status' => $this->status,
            'notes' => $this->notes,
        ];
    }
}
