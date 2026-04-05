<?php

namespace App\Services\Accounting;

use App\Interfaces\Accounting\GlInterface;
use App\DTOs\Accounting\GlDTO;
use App\Models\Accounting\Gl;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class GlService
{
    public function __construct(
        protected GlInterface $repository
    ) {}

    public function getEntries(int $perPage = 15, string $search = '', array $filters = []): LengthAwarePaginator
    {
        return $this->repository->index($perPage, $search, $filters);
    }

    public function recordEntry(GlDTO $dto): Gl
    {
        return $this->repository->create($dto->toArray());
    }

    public function recordDoubleEntry(array $debitData, array $creditData): bool
    {
        if ($debitData['amount'] != $creditData['amount']) {
            throw new \Exception('Debit and Credit amounts must match');
        }

        return DB::transaction(function () use ($debitData, $creditData) {
            $this->repository->create([
                'entry_date' => $debitData['entry_date'],
                'account_name' => $debitData['account_name'],
                'account_type' => $debitData['account_type'],
                'debit' => $debitData['amount'],
                'credit' => 0,
                'reference' => $debitData['reference'],
                'description' => $debitData['description'],
            ]);

            $this->repository->create([
                'entry_date' => $creditData['entry_date'],
                'account_name' => $creditData['account_name'],
                'account_type' => $creditData['account_type'],
                'debit' => 0,
                'credit' => $creditData['amount'],
                'reference' => $creditData['reference'],
                'description' => $creditData['description'],
            ]);

            return true;
        });
    }

    public function getAccountBalance(string $accountName): float
    {
        return $this->repository->getBalance($accountName);
    }

    public function getTrialBalance(): array
    {
        $accounts = Gl::select('account_name', DB::raw('SUM(debit) as total_debit'), DB::raw('SUM(credit) as total_credit'))
            ->groupBy('account_name')
            ->get();

        return [
            'accounts' => $accounts,
            'total_debit' => $accounts->sum('total_debit'),
            'total_credit' => $accounts->sum('total_credit'),
            'is_balanced' => $accounts->sum('total_debit') == $accounts->sum('total_credit')
        ];
    }

    public function getAccountingStats(): array
    {
        $accounts = $this->repository->all();
        $totalRevenue = $accounts->where('account_type', 'Revenue')->sum(fn($a) => $a->credit - $a->debit);
        $totalExpense = $accounts->where('account_type', 'Expense')->sum(fn($a) => $a->debit - $a->credit);

        return [
            'total_revenue' => $totalRevenue,
            'total_expense' => $totalExpense,
            'net_income' => $totalRevenue - $totalExpense,
            'account_count' => $accounts->count()
        ];
    }

    public function getEntryById(int $id): ?Gl
    {
        return $this->repository->read($id);
    }

    public function updateEntry(int $id, GlDTO $dto): bool
    {
        return $this->repository->update($id, $dto->toArray());
    }

    public function deleteEntry(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
