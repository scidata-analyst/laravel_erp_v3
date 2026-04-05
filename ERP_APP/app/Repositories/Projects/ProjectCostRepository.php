<?php

namespace App\Repositories\Projects;

use App\Interfaces\Projects\ProjectCostInterface;
use App\Models\Projects\ProjectCost;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class ProjectCostRepository implements ProjectCostInterface
{
    public function all(): Collection
    {
        return ProjectCost::all();
    }

    public function index(int $perPage = 15): LengthAwarePaginator
    {
        return ProjectCost::with(['project', 'approvedBy'])->paginate($perPage);
    }

    public function create(array $data): ProjectCost
    {
        return ProjectCost::create($data);
    }

    public function read(int $id): ?ProjectCost
    {
        return ProjectCost::with(['project', 'approvedBy'])->find($id);
    }

    public function update(int $id, array $data): bool
    {
        $cost = $this->read($id);
        return $cost ? $cost->update($data) : false;
    }

    public function delete(int $id): bool
    {
        $cost = $this->read($id);
        return $cost ? $cost->delete() : false;
    }

    public function getByProject(int $projectId): Collection
    {
        return ProjectCost::where('project_id', $projectId)->get();
    }

    public function approve(int $id, int $userId): bool
    {
        $cost = $this->read($id);
        if (!$cost) return false;

        return $cost->update([
            'status' => 'Approved',
            'approved_by' => $userId
        ]);
    }
}