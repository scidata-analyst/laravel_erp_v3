<?php

namespace App\Repositories\Reports;

use App\Interfaces\Reports\BiWidgetsInterface;
use App\Models\Reports\BiWidgets;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class BiWidgetsRepository implements BiWidgetsInterface
{
    public function all(): Collection
    {
        return BiWidgets::all();
    }

    public function index(int $perPage = 15): LengthAwarePaginator
    {
        return BiWidgets::with(['dashboard'])->paginate($perPage);
    }

    public function create(array $data): BiWidgets
    {
        return BiWidgets::create($data);
    }

    public function read(int $id): ?BiWidgets
    {
        return BiWidgets::with(['dashboard'])->find($id);
    }

    public function update(int $id, array $data): bool
    {
        $widget = $this->read($id);
        return $widget ? $widget->update($data) : false;
    }

    public function delete(int $id): bool
    {
        $widget = $this->read($id);
        return $widget ? $widget->delete() : false;
    }

    public function getByDashboard(int $dashboardId): Collection
    {
        return BiWidgets::where('dashboard_id', $dashboardId)->get();
    }
}
