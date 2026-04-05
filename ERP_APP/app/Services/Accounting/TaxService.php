<?php

namespace App\Services\Accounting;

use App\Interfaces\Accounting\TaxInterface;
use App\DTOs\Accounting\TaxDTO;
use App\Models\Accounting\Tax;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class TaxService
{
    public function __construct(
        protected TaxInterface $repository
    ) {}

    public function getTaxes(int $perPage = 15, string $search = '', array $filters = []): LengthAwarePaginator
    {
        return $this->repository->index($perPage, $search, $filters);
    }

    public function createTax(TaxDTO $dto): Tax
    {
        return $this->repository->create($dto->toArray());
    }

    public function getTaxById(int $id): ?Tax
    {
        return $this->repository->read($id);
    }

    public function updateTax(int $id, TaxDTO $dto): bool
    {
        return $this->repository->update($id, $dto->toArray());
    }

    public function deleteTax(int $id): bool
    {
        return $this->repository->delete($id);
    }

    public function calculateTax(float $amount, int $taxId): float
    {
        $tax = $this->repository->read($taxId);
        if (!$tax) {
            throw new \Exception('Tax configuration not found');
        }

        if ($tax->tax_type === 'percentage') {
            return $amount * ($tax->tax_rate / 100);
        }

        return $tax->tax_rate; // Fixed amount
    }

    public function getActiveTaxOptions(): Collection
    {
        return $this->repository->getActiveTaxes();
    }
}
