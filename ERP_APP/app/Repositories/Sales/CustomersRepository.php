<?php

namespace App\Repositories\Sales;

use App\Interfaces\Sales\CustomersInterface;
use App\Models\Sales\Customers;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class CustomersRepository implements CustomersInterface
{
    public function all(): Collection
    {
        return Customers::all();
    }

    public function index(int $perPage = 15, string $search = '', array $filters = []): LengthAwarePaginator
    {
        $query = Customers::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('contact_person', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%')
                  ->orWhere('phone', 'like', '%' . $search . '%');
            });
        }

        if (!empty($filters)) {
            foreach ($filters as $filter) {
                if (isset($filter['field']) && isset($filter['value'])) {
                    $query->where($filter['field'], $filter['value']);
                }
            }
        }

        return $query->paginate($perPage);
    }

    public function create(array $data): Customers
    {
        return Customers::create($data);
    }

    public function read(int $id): ?Customers
    {
        return Customers::find($id);
    }

    public function update(int $id, array $data): bool
    {
        $customer = $this->read($id);
        return $customer ? $customer->update($data) : false;
    }

    public function delete(int $id): bool
    {
        $customer = $this->read($id);
        return $customer ? $customer->delete() : false;
    }

    public function getByStatus(string $status): Collection
    {
        return Customers::where('status', $status)->get();
    }

    public function findByEmail(string $email): ?Customers
    {
        return Customers::where('email', $email)->first();
    }
}