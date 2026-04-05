<?php

namespace App\Repositories\Projects;

use App\Interfaces\Projects\ResourcesInterface;
use App\Models\Projects\Resources;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class ResourcesRepository implements ResourcesInterface
{
    public function all(): Collection
    {
        return Resources::all();
    }

    public function index(int $perPage = 15): LengthAwarePaginator
    {
        return Resources::with(['project'])->paginate($perPage);
    }

    public function create(array $data): Resources
    {
        return Resources::create($data);
    }

    public function read(int $id): ?Resources
    {
        return Resources::with(['project'])->find($id);
    }

    public function update(int $id, array $data): bool
    {
        $resource = $this->read($id);
        return $resource ? $resource->update($data) : false;
    }

    public function delete(int $id): bool
    {
        $resource = $this->read($id);
        return $resource ? $resource->delete() : false;
    }

    public function getByProject(int $projectId): Collection
    {
        return Resources::where('project_id', $projectId)->get();
    }

    public function updateAllocation(int $id, int $percentage): bool
    {
        $resource = $this->read($id);
        if (!$resource) return false;

        return $resource->update(['allocation_percentage' => $percentage]);
    }
}