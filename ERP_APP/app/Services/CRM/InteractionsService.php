<?php

namespace App\Services\CRM;

use App\Interfaces\CRM\InteractionsInterface;
use App\DTOs\CRM\InteractionsDTO;
use App\Models\CRM\Interactions;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class InteractionsService
{
    public function __construct(
        protected InteractionsInterface $repository
    ) {}

    public function getInteractions(int $perPage = 15, string $search = '', array $filters = []): LengthAwarePaginator
    {
        return $this->repository->index($perPage, $search, $filters);
    }

    public function addInteraction(InteractionsDTO $dto): Interactions
    {
        return $this->repository->create($dto->toArray());
    }

    public function getInteractionById(int $id): ?Interactions
    {
        return $this->repository->read($id);
    }

    public function updateInteraction(int $id, InteractionsDTO $dto): bool
    {
        return $this->repository->update($id, $dto->toArray());
    }

    public function getInteractionsBySubject(int $id, string $type): Collection
    {
        return $this->repository->getBySubject($id, $type);
    }

    public function deleteInteraction(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
