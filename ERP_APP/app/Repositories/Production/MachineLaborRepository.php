<?php

namespace App\Repositories\Production;

use App\Interfaces\Production\MachineLaborInterface;
use App\Models\Production\MachineLabor;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class MachineLaborRepository implements MachineLaborInterface
{
    public function all(): Collection
    {
        return MachineLabor::all();
    }

    public function index(int $perPage = 15): LengthAwarePaginator
    {
        return MachineLabor::with(['workOrder'])->paginate($perPage);
    }

    public function create(array $data): MachineLabor
    {
        return MachineLabor::create($data);
    }

    public function read(int $id): ?MachineLabor
    {
        return MachineLabor::with(['workOrder'])->find($id);
    }

    public function update(int $id, array $data): bool
    {
        $ml = $this->read($id);
        return $ml ? $ml->update($data) : false;
    }

    public function delete(int $id): bool
    {
        $ml = $this->read($id);
        return $ml ? $ml->delete() : false;
    }

    public function getByWorkOrder(int $workOrderId): Collection
    {
        return MachineLabor::where('work_order_id', $workOrderId)->get();
    }
}