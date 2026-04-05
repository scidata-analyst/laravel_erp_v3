<?php

namespace App\Services\CRM;

use App\Interfaces\CRM\SupportInterface;
use App\DTOs\CRM\SupportDTO;
use App\Models\CRM\Support;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class SupportService
{
    public function __construct(
        protected SupportInterface $repository
    ) {}

    public function getTickets(int $perPage = 15, string $search = '', array $filters = []): LengthAwarePaginator
    {
        return $this->repository->index($perPage, $search, $filters);
    }

    public function createTicket(SupportDTO $dto): Support
    {
        return $this->repository->create($dto->toArray());
    }

    public function getTicketById(int $id): ?Support
    {
        return $this->repository->read($id);
    }

    public function resolveTicket(int $id, string $resolution): bool
    {
        return $this->repository->resolveTicket($id, $resolution);
    }

    public function getTicketsByCustomer(int $customerId): Collection
    {
        return $this->repository->getByCustomer($customerId);
    }

    public function updateTicket(int $id, SupportDTO $dto): bool
    {
        return $this->repository->update($id, $dto->toArray());
    }

    public function deleteTicket(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
