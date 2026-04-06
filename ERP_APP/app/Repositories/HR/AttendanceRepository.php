<?php

namespace App\Repositories\HR;

use App\Models\HR\Attendance;

class AttendanceRepository
{
    public function all()
    {
        return Attendance::query()->get();
    }

    public function find(int $id)
    {
        return Attendance::query()->findOrFail($id);
    }

    public function create(array $data)
    {
        return Attendance::query()->create($data);
    }

    public function update(int $id, array $data)
    {
        $record = $this->find($id);
        $record->update($data);

        return $record->refresh();
    }

    public function delete(int $id): bool
    {
        return (bool) $this->find($id)->delete();
    }
}
