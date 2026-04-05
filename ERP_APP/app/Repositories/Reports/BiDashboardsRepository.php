<?php

namespace App\Repositories\Reports;

use App\Interfaces\Reports\BiDashboardsInterface;
use App\Models\Reports\BiDashboards;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class BiDashboardsRepository implements BiDashboardsInterface
{
    public function all(): Collection
    {
        return BiDashboards::all();
    }

    public function index(int $perPage = 15): LengthAwarePaginator
    {
        return BiDashboards::with(['createdBy', 'widgets'])->paginate($perPage);
    }

    public function create(array $data): BiDashboards
    {
        return BiDashboards::create($data);
    }

    public function read(int $id): ?BiDashboards
    {
        return BiDashboards::with(['createdBy', 'widgets'])->find($id);
    }

    public function update(int $id, array $data): bool
    {
        $dashboard = $this->read($id);
        return $dashboard ? $dashboard->update($data) : false;
    }

    public function delete(int $id): bool
    {
        $dashboard = $this->read($id);
        return $dashboard ? $dashboard->delete() : false;
    }

    public function getUserDashboards(int $userId): Collection
    {
        return BiDashboards::where('created_by', $userId)->get();
    }
}
