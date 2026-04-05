<?php

namespace App\Http\Resources\HR;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AttendanceResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'employee' => new EmployeesResource($this->whenLoaded('employee')),
            'employee_id' => $this->employee_id,
            'employee_name' => $this->employee?->full_name,
            'attendance_date' => $this->date?->toDateString(),
            'date' => $this->date?->toDateString(),
            'check_in' => $this->check_in,
            'check_out' => $this->check_out,
            'status' => match ($this->status) {
                'present' => 'Present',
                'absent' => 'Absent',
                'late' => 'Late',
                'early_leave' => 'Early Leave',
                default => $this->status,
            },
            'notes' => $this->notes,
            'created_at' => $this->created_at->toDateTimeString(),
        ];
    }
}
