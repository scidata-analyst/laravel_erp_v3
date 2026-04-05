<?php

namespace App\Repositories\Core;

use App\Interfaces\Core\DashboardInterface;
use App\Models\Core\Dashboard;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class DashboardRepository implements DashboardInterface
{
    public function all(): Collection
    {
        return Dashboard::all();
    }

    public function index(int $perPage = 15): LengthAwarePaginator
    {
        return Dashboard::paginate($perPage);
    }

    public function create(array $data): Dashboard
    {
        return Dashboard::create($data);
    }

    public function read(int $id): ?Dashboard
    {
        return Dashboard::find($id);
    }

    public function update(int $id, array $data): bool
    {
        $metric = $this->read($id);
        return $metric ? $metric->update($data) : false;
    }

    public function delete(int $id): bool
    {
        $metric = $this->read($id);
        return $metric ? $metric->delete() : false;
    }

    public function getByCategory(string $category): Collection
    {
        return Dashboard::where('category', $category)->get();
    }

    public function getLatestMetrics(): Collection
    {
        return Dashboard::orderBy('created_at', 'desc')->take(10)->get();
    }
}