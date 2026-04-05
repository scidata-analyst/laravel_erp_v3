<?php

namespace App\Services\Logistics;

use App\Interfaces\Logistics\RoutesInterface;
use App\DTOs\Logistics\RoutesDTO;
use App\Models\Logistics\Routes;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class RoutesService
{
    public function __construct(
        protected RoutesInterface $repository
    ) {}

    public function getRoutes(int $perPage = 15, string $search = '', array $filters = []): LengthAwarePaginator
    {
        return $this->repository->index($perPage, $search, $filters);
    }

    public function createRoute(RoutesDTO $dto): Routes
    {
        return $this->repository->create($dto->toArray());
    }

    public function getRouteById(int $id): ?Routes
    {
        return $this->repository->read($id);
    }

    public function getActiveDeliveryRoutes(): Collection
    {
        return $this->repository->getActiveRoutes();
    }
}
