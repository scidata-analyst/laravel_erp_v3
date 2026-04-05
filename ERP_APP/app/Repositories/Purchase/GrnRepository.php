<?php

namespace App\Repositories\Purchase;

use App\Interfaces\Purchase\GrnInterface;
use App\Models\Purchase\Grn;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class GrnRepository implements GrnInterface
{
    public function all(): Collection
    {
        return Grn::all();
    }

    public function index(int $perPage = 15): LengthAwarePaginator
    {
        return Grn::with(['purchaseOrder.supplier', 'items', 'receivedBy'])->paginate($perPage);
    }

    public function create(array $data): Grn
    {
        return Grn::create($data);
    }

    public function read(int $id): ?Grn
    {
        return Grn::with(['purchaseOrder.supplier', 'supplier', 'items', 'receivedBy'])->find($id);
    }

    public function update(int $id, array $data): bool
    {
        $grn = $this->read($id);
        return $grn ? $grn->update($data) : false;
    }

    public function delete(int $id): bool
    {
        $grn = $this->read($id);
        return $grn ? $grn->delete() : false;
    }

    public function getByOrder(int $orderId): Collection
    {
        return Grn::where('purchase_order_id', $orderId)->get();
    }
}
