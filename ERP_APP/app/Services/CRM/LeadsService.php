<?php

namespace App\Services\CRM;

use App\Interfaces\CRM\LeadsInterface;
use App\DTOs\CRM\LeadsDTO;
use App\Models\CRM\Leads;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class LeadsService
{
    public function __construct(
        protected LeadsInterface $repository
    ) {}

    public function getLeads(int $perPage = 15, string $search = '', array $filters = []): LengthAwarePaginator
    {
        return $this->repository->index($perPage, $search, $filters);
    }

    public function createLead(LeadsDTO $dto): Leads
    {
        return $this->repository->create($dto->toArray());
    }

    public function getLeadById(int $id): ?Leads
    {
        return $this->repository->read($id);
    }

    public function updateLead(int $id, LeadsDTO $dto): bool
    {
        return $this->repository->update($id, $dto->toArray());
    }

    public function deleteLead(int $id): bool
    {
        return $this->repository->delete($id);
    }

    public function convertToCustomer(int $id)
    {
        return $this->repository->convertToCustomer($id);
    }
}
