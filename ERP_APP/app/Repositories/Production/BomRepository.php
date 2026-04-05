<?php

namespace App\Repositories\Production;

use App\Interfaces\Production\BomInterface;
use App\Models\Production\Bom;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class BomRepository implements BomInterface
{
    public function all(): Collection
    {
        return Bom::all();
    }

    public function index(int $perPage = 15): LengthAwarePaginator
    {
        return Bom::paginate($perPage);
    }

    public function create(array $data): Bom
    {
        return Bom::create($data);
    }

    public function read(int $id): ?Bom
    {
        return Bom::find($id);
    }

    public function update(int $id, array $data): bool
    {
        $bom = $this->read($id);
        return $bom ? $bom->update($data) : false;
    }

    public function delete(int $id): bool
    {
        $bom = $this->read($id);
        return $bom ? $bom->delete() : false;
    }

    public function getActiveByProduct(int $productId): ?Bom
    {
        return Bom::where('product_id', $productId)
            ->where('status', 'active')
            ->first();
    }
}
