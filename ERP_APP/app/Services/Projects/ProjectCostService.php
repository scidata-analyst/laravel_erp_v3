<?php

namespace App\Services\Projects;

use App\Interfaces\Projects\ProjectCostInterface;
use App\DTOs\Projects\ProjectCostDTO;
use App\Models\Projects\ProjectCost;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class ProjectCostService
{
    public function __construct(
        protected ProjectCostInterface $repository
    ) {}

    public function getProjectCosts(int $perPage = 15, string $search = '', array $filters = []): LengthAwarePaginator
    {
        return $this->repository->index($perPage, $search, $filters);
    }

    public function addCost(ProjectCostDTO $dto): ProjectCost
    {
        return $this->repository->create($dto->toArray());
    }

    public function getCostsInProject(int $projectId): Collection
    {
        return $this->repository->getByProject($projectId);
    }

    public function approveCost(int $id, int $userId): bool
    {
        return $this->repository->approve($id, $userId);
    }

    public function getCostSummary(int $projectId): array
    {
        $costs = $this->repository->getByProject($projectId);
        
        $totalBudgeted = $costs->sum('budgeted_amount');
        $totalActual = $costs->sum('actual_amount');
        
        return [
            'total_budgeted' => $totalBudgeted,
            'total_actual' => $totalActual,
            'variance' => $totalActual - $totalBudgeted,
            'variance_percentage' => $totalBudgeted > 0 ? (($totalActual - $totalBudgeted) / $totalBudgeted) * 100 : 0
        ];
    }

    public function getCostById(int $id): ?ProjectCost
    {
        return $this->repository->read($id);
    }

    public function updateCost(int $id, ProjectCostDTO $dto): bool
    {
        return $this->repository->update($id, $dto->toArray());
    }

    public function deleteCost(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
