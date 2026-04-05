<?php

namespace App\Services\Ecommerce;

use App\DTOs\Ecommerce\PosDTO;
use App\Interfaces\Ecommerce\PosInterface;
use App\Models\Ecommerce\Pos;
use Illuminate\Pagination\LengthAwarePaginator;

class PosService
{
    public function __construct(
        protected PosInterface $repository
    ) {}

    public function getPosTerminals(int $perPage = 15, string $search = '', array $filters = []): LengthAwarePaginator
    {
        return $this->repository->index($perPage, $search, $filters);
    }

    public function createPosTerminal(PosDTO $dto): Pos
    {
        return $this->repository->create($dto->toArray());
    }

    public function getPosTerminalById(int $id): ?Pos
    {
        return $this->repository->read($id);
    }

    public function updatePosTerminal(int $id, PosDTO $dto): bool
    {
        return $this->repository->update($id, $dto->toArray());
    }

    public function deletePosTerminal(int $id): bool
    {
        return $this->repository->delete($id);
    }

    public function getActiveTerminalCount(): int
    {
        return method_exists($this->repository, 'activeCount') ? $this->repository->activeCount() : 0;
    }
}
