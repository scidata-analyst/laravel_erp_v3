<?php

namespace App\Repositories\Production;

use App\Interfaces\Production\WorkOrdersInterface;
use App\Models\Production\WorkOrders;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class WorkOrdersRepository implements WorkOrdersInterface
{
    public function all(): Collection
    {
        return WorkOrders::all();
    }

    public function index(int $perPage = 15): LengthAwarePaginator
    {
        return WorkOrders::with(['bom', 'assignedWorkshop'])->paginate($perPage);
    }

    public function create(array $data): WorkOrders
    {
        return WorkOrders::create($data);
    }

    public function read(int $id): ?WorkOrders
    {
        return WorkOrders::with(['bom', 'assignedWorkshop', 'machineLabor'])->find($id);
    }

    public function update(int $id, array $data): bool
    {
        $wo = $this->read($id);
        return $wo ? $wo->update($data) : false;
    }

    public function delete(int $id): bool
    {
        $wo = $this->read($id);
        return $wo ? $wo->delete() : false;
    }

    public function getByStatus(string $status): Collection
    {
        return WorkOrders::where('status', $status)->get();
    }

    public function updateProgress(int $id, int $producedQty, int $scrapQty): bool
    {
        $wo = $this->read($id);
        if (!$wo) return false;

        $wo->actual_qty_produced += $producedQty;
        $wo->scrap_quantity += $scrapQty;
        
        if ($wo->actual_qty_produced >= $wo->qty_to_produce) {
            $wo->status = 'Completed';
        } else {
            $wo->status = 'In Progress';
        }

        return $wo->save();
    }
}