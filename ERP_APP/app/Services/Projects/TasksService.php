<?php

namespace App\Services\Projects;

use App\Interfaces\Projects\TasksInterface;
use App\DTOs\Projects\TasksDTO;
use App\Models\Projects\Tasks;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class TasksService
{
    public function __construct(
        protected TasksInterface $repository
    ) {}

    public function getTasks(int $perPage = 15, string $search = '', array $filters = []): LengthAwarePaginator
    {
        return $this->repository->index($perPage, $search, $filters);
    }

    public function createTask(TasksDTO $dto): Tasks
    {
        return $this->repository->create($dto->toArray());
    }

    public function getTaskById(int $id): ?Tasks
    {
        return $this->repository->read($id);
    }

    public function updateTaskProgress(int $id, int $percentage): bool
    {
        return $this->repository->updateProgress($id, $percentage);
    }

    public function getTasksInProject(string $projectName): Collection
    {
        return $this->repository->getByProject($projectName);
    }

    public function updateTask(int $id, TasksDTO $dto): bool
    {
        return $this->repository->update($id, $dto->toArray());
    }

    public function deleteTask(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
