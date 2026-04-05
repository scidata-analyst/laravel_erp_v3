<?php

namespace App\Repositories\Accounting;

use App\Interfaces\Accounting\TaxInterface;
use App\Models\Accounting\Tax;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class TaxRepository implements TaxInterface
{
    public function all(): Collection
    {
        return Tax::all();
    }

    public function index(int $perPage = 15): LengthAwarePaginator
    {
        return Tax::paginate($perPage);
    }

    public function create(array $data): Tax
    {
        return Tax::create($data);
    }

    public function read(int $id): ?Tax
    {
        return Tax::find($id);
    }

    public function update(int $id, array $data): bool
    {
        $tax = $this->read($id);
        return $tax ? $tax->update($data) : false;
    }

    public function delete(int $id): bool
    {
        $tax = $this->read($id);
        return $tax ? $tax->delete() : false;
    }

    public function getActiveTaxes(): Collection
    {
        return Tax::where('is_active', true)->get();
    }
}