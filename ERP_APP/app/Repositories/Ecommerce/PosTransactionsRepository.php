<?php

namespace App\Repositories\Ecommerce;

use App\Interfaces\Ecommerce\PosTransactionsInterface;
use App\Models\Ecommerce\PosTransactions;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class PosTransactionsRepository implements PosTransactionsInterface
{
    public function all(): Collection
    {
        return PosTransactions::all();
    }

    public function index(int $perPage = 15): LengthAwarePaginator
    {
        return PosTransactions::with(['terminal', 'customer', 'salesOrder'])->paginate($perPage);
    }

    public function create(array $data): PosTransactions
    {
        return PosTransactions::create($data);
    }

    public function read(int $id): ?PosTransactions
    {
        return PosTransactions::with(['terminal', 'customer', 'salesOrder'])->find($id);
    }

    public function update(int $id, array $data): bool
    {
        $transaction = $this->read($id);
        return $transaction ? $transaction->update($data) : false;
    }

    public function delete(int $id): bool
    {
        $transaction = $this->read($id);
        return $transaction ? $transaction->delete() : false;
    }

    public function getByTerminal(int $terminalId): Collection
    {
        return PosTransactions::where('terminal_id', $terminalId)->get();
    }

    public function getDailySales(string $date): Collection
    {
        return PosTransactions::whereDate('created_at', $date)->get();
    }
}
