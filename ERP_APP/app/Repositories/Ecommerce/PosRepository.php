<?php

namespace App\Repositories\Ecommerce;

use App\Interfaces\Ecommerce\PosInterface;
use App\Models\Ecommerce\Pos;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class PosRepository implements PosInterface
{
    public function all(): Collection
    {
        return Pos::with(['currentUser', 'transactions'])->get();
    }

    public function index(int $perPage = 15): LengthAwarePaginator
    {
        return Pos::with(['currentUser', 'transactions'])->paginate($perPage);
    }

    public function create($data): Pos
    {
        return Pos::create($data);
    }

    public function read($id): ?Pos
    {
        return Pos::with(['currentUser', 'transactions'])->find($id);
    }

    public function update($id, $data): bool
    {
        $terminal = $this->read($id);
        return $terminal ? $terminal->update($data) : false;
    }

    public function delete($id): bool
    {
        $terminal = $this->read($id);
        return $terminal ? $terminal->delete() : false;
    }

    public function activeCount(): int
    {
        return Pos::where('status', 'active')->count();
    }
}
