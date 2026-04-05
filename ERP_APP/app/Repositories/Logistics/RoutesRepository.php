<?php

namespace App\Repositories\Logistics;

use App\Interfaces\Logistics\RoutesInterface;
use App\Models\Logistics\Routes;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class RoutesRepository implements RoutesInterface
{
    public function all(): Collection
    {
        return Routes::all();
    }

    public function index(int $perPage = 15): LengthAwarePaginator
    {
        return Routes::paginate($perPage);
    }

    public function create(array $data): Routes
    {
        return Routes::create($data);
    }

    public function read(int $id): ?Routes
    {
        return Routes::find($id);
    }

    public function update(int $id, array $data): bool
    {
        $route = $this->read($id);
        return $route ? $route->update($data) : false;
    }

    public function delete(int $id): bool
    {
        $route = $this->read($id);
        return $route ? $route->delete() : false;
    }

    public function getActiveRoutes(): Collection
    {
        return Routes::where('status', 'Active')->get();
    }
}