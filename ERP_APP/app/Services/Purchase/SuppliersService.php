<?php

namespace App\Services\Purchase;

use App\Interfaces\Purchase\SuppliersInterface;
use App\DTOs\Purchase\SuppliersDTO;
use App\Models\Purchase\Suppliers;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class SuppliersService
{
    public function __construct(
        protected SuppliersInterface $repository
    ) {}

    public function getSuppliers(int $perPage = 15, string $search = '', array $filters = []): LengthAwarePaginator
    {
        return $this->repository->index($perPage, $search, $filters);
    }

    public function createSupplier(SuppliersDTO $dto): Suppliers
    {
        return $this->repository->create($dto->toArray());
    }

    public function getSupplierById(int $id): ?Suppliers
    {
        return $this->repository->read($id);
    }

    public function updateSupplier(int $id, SuppliersDTO $dto): bool
    {
        return $this->repository->update($id, $dto->toArray());
    }

    public function deleteSupplier(int $id): bool
    {
        $supplier = $this->repository->read($id);
        if (!$supplier) {
            throw new \Exception('Supplier not found');
        }

        // Business Logic: Check if supplier has pending purchase orders
        if ($supplier->purchaseOrders()->whereNotIn('status', ['completed', 'cancelled'])->count() > 0) {
            throw new \Exception('Cannot delete supplier with active purchase orders');
        }

        return $this->repository->delete($id);
    }

    public function getSupplierStats(): array
    {
        return [
            'total_suppliers' => Suppliers::count(),
            'active_suppliers' => Suppliers::where('status', 'active')->count(),
            'total_categories' => Suppliers::distinct('category')->count(),
        ];
    }
}
