<?php

namespace App\Repositories\Projects;

use App\Interfaces\Projects\TasksInterface;
use App\Models\Projects\Tasks;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class TasksRepository implements TasksInterface
{
    public function all(): Collection
    {
        return Tasks::all();
    }

    public function index(int $perPage = 15): LengthAwarePaginator
    {
        return Tasks::with(['assignedUser'])->paginate($perPage);
    }

    public function create(array $data): Tasks
    {
        return Tasks::create($data);
    }

    public function read(int $id): ?Tasks
    {
        return Tasks::with(['assignedUser', 'projectCosts'])->find($id);
    }

    public function update(int $id, array $data): bool
    {
        $task = $this->read($id);
        return $task ? $task->update($data) : false;
    }

    public function delete(int $id): bool
    {
        $task = $this->read($id);
        return $task ? $task->delete() : false;
    }

    public function getByProject(string $projectName): Collection
    {
        return Tasks::where('project_name', $projectName)->get();
    }

    public function updateProgress(int $id, int $percentage): bool
    {
        $task = $this->read($id);
        if (!$task) return false;

        return $task->update([
            'progress_percentage' => $percentage,
            'status' => $percentage >= 100 ? 'Completed' : 'In Progress'
        ]);
    }
}