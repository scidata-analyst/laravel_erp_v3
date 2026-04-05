<?php

namespace App\Services\Logistics;

use App\Interfaces\Logistics\ShipmentsInterface;
use App\DTOs\Logistics\ShipmentsDTO;
use App\Models\Logistics\Shipments;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class ShipmentsService
{
    public function __construct(
        protected ShipmentsInterface $repository
    ) {}

    public function getShipments(int $perPage = 15, string $search = '', array $filters = []): LengthAwarePaginator
    {
        return $this->repository->index($perPage, $search, $filters);
    }

    public function createShipment(ShipmentsDTO $dto): Shipments
    {
        return $this->repository->create($dto->toArray());
    }

    public function getShipmentById(int $id): ?Shipments
    {
        return $this->repository->read($id);
    }

    public function updateShipment(int $id, ShipmentsDTO $dto): bool
    {
        return $this->repository->update($id, $dto->toArray());
    }

    public function deleteShipment(int $id): bool
    {
        return $this->repository->delete($id);
    }

    public function updateShipmentStatus(int $id, string $status): bool
    {
        return $this->repository->updateStatus($id, $status);
    }
}
