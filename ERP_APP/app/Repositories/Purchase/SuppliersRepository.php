<?php

namespace App\Repositories\Purchase;

use App\Interfaces\Purchase\SuppliersInterface;
use App\Models\Purchase\Suppliers;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class SuppliersRepository implements SuppliersInterface
{
    public function all(): Collection
    {
        return Suppliers::all();
    }

    public function index(int $perPage = 15): LengthAwarePaginator
    {
        return Suppliers::paginate($perPage);
    }

    public function create(array $data): Suppliers
    {
        return Suppliers::create($data);
    }

    public function read(int $id): ?Suppliers
    {
        return Suppliers::find($id);
    }

    public function update(int $id, array $data): bool
    {
        $supplier = $this->read($id);
        return $supplier ? $supplier->update($data) : false;
    }

    public function delete(int $id): bool
    {
        $supplier = $this->read($id);
        return $supplier ? $supplier->delete() : false;
    }

    public function getByCategory(string $category): Collection
    {
        return Suppliers::where('category', $category)->get();
    }
}