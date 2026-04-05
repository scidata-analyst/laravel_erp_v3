<?php

namespace App\Repositories\Sales;

use App\Interfaces\Sales\DiscountsInterface;
use App\Models\Sales\Discounts;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class DiscountsRepository implements DiscountsInterface
{
    public function all(): Collection
    {
        return Discounts::all();
    }

    public function index(int $perPage = 15): LengthAwarePaginator
    {
        return Discounts::paginate($perPage);
    }

    public function create(array $data): Discounts
    {
        return Discounts::create($data);
    }

    public function read(int $id): ?Discounts
    {
        return Discounts::find($id);
    }

    public function update(int $id, array $data): bool
    {
        $discount = $this->read($id);
        return $discount ? $discount->update($data) : false;
    }

    public function delete(int $id): bool
    {
        $discount = $this->read($id);
        return $discount ? $discount->delete() : false;
    }

    public function findByCode(string $code): ?Discounts
    {
        return Discounts::where('discount_name', $code)->first();
    }
}
