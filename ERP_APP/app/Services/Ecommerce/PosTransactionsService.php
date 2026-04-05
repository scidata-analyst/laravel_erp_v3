<?php

namespace App\Services\Ecommerce;

use App\Interfaces\Ecommerce\PosTransactionsInterface;
use App\DTOs\Ecommerce\PosTransactionsDTO;
use App\Models\Ecommerce\PosTransactions;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class PosTransactionsService
{
    public function __construct(
        protected PosTransactionsInterface $repository
    ) {}

    public function getTransactions(int $perPage = 15, string $search = '', array $filters = []): LengthAwarePaginator
    {
        return $this->repository->index($perPage, $search, $filters);
    }

    public function processTransaction(PosTransactionsDTO $dto): PosTransactions
    {
        return $this->repository->create($dto->toArray());
    }

    public function getTransactionById(int $id): ?PosTransactions
    {
        return $this->repository->read($id);
    }

    public function getSalesByTerminal(int $terminalId): Collection
    {
        return $this->repository->getByTerminal($terminalId);
    }

    public function getDailyTotal(string $date): float
    {
        return $this->repository->getDailySales($date)->sum('total_amount');
    }
}
