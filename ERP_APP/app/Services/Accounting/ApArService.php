<?php

namespace App\Services\Accounting;

use App\Interfaces\Accounting\ApArInterface;
use App\DTOs\Accounting\ApArDTO;
use App\Models\Accounting\ApAr;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class ApArService
{
    public function __construct(
        protected ApArInterface $repository
    ) {}

    public function all(): Collection
    {
        return $this->repository->all();
    }

    public function getTransactions(int $perPage = 15, string $search = '', array $filters = []): LengthAwarePaginator
    {
        return $this->repository->index($perPage, $search, $filters);
    }

    public function recordTransaction(ApArDTO $dto): ApAr
    {
        return $this->repository->create($dto->toArray());
    }

    public function getPartyBalance(string $partyName): float
    {
        return $this->repository->getOutstandingBalance($partyName);
    }

    public function getOverdueTransactions(): Collection
    {
        return ApAr::where('due_date', '<', now())
            ->where('status', '!=', 'paid')
            ->get();
    }

    public function getTransactionById(int $id): ?ApAr
    {
        return $this->repository->read($id);
    }

    public function updateTransaction(int $id, ApArDTO $dto): bool
    {
        return $this->repository->update($id, $dto->toArray());
    }

    public function deleteTransaction(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
