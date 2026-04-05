<?php

namespace App\Repositories\Accounting;

use App\Interfaces\Accounting\ApArInterface;
use App\Models\Accounting\ApAr;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class ApArRepository implements ApArInterface
{
    public function all(): Collection
    {
        return ApAr::all();
    }

    public function index(int $perPage = 15): LengthAwarePaginator
    {
        return ApAr::paginate($perPage);
    }

    public function create(array $data): ApAr
    {
        return ApAr::create($data);
    }

    public function read(int $id): ?ApAr
    {
        return ApAr::find($id);
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

    public function getByParty(string $partyName): Collection
    {
        return ApAr::where('party_name', $partyName)->get();
    }

    public function getOutstandingBalance(string $partyName): float
    {
        $invoices = ApAr::where('party_name', $partyName)
            ->whereIn('transaction_type', ['Invoice', 'Debit Note'])
            ->sum('amount');
        
        $payments = ApAr::where('party_name', $partyName)
            ->whereIn('transaction_type', ['Payment', 'Credit Note'])
            ->sum('amount');
            
        return $invoices - $payments;
    }
}