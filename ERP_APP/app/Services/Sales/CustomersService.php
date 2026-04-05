<?php

namespace App\Services\Sales;

use App\Interfaces\Sales\CustomersInterface;
use App\DTOs\Sales\CustomersDTO;
use App\Models\Sales\Customers;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class CustomersService
{
    public function __construct(
        protected CustomersInterface $repository
    ) {}

    public function getCustomers(int $perPage = 15, string $search = '', array $filters = []): LengthAwarePaginator
    {
        return $this->repository->index($perPage, $search, $filters);
    }

    public function createCustomer(CustomersDTO $dto): Customers
    {
        return $this->repository->create($dto->toArray());
    }

    public function getCustomerById(int $id): ?Customers
    {
        return $this->repository->read($id);
    }

    public function updateCustomer(int $id, CustomersDTO $dto): bool
    {
        return $this->repository->update($id, $dto->toArray());
    }

    public function deleteCustomer(int $id): bool
    {
        $customer = $this->repository->read($id);
        if (!$customer) {
            throw new \Exception('Customer not found');
        }

        // Business Logic: Check if customer has orders
        if ($customer->salesOrders()->count() > 0) {
            throw new \Exception('Cannot delete customer with existing orders');
        }

        return $this->repository->delete($id);
    }

    public function getCustomerStats(): array
    {
        return [
            'total_customers' => Customers::count(),
            'active_customers' => Customers::where('status', 'active')->count(),
            'inactive_customers' => Customers::where('status', 'inactive')->count(),
            'total_credit_limit' => Customers::sum('credit_limit'),
        ];
    }
}
