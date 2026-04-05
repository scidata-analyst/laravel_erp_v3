<?php

namespace App\Repositories\Accounting;

use App\Interfaces\Accounting\GlInterface;
use App\Models\Accounting\Gl;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class GlRepository implements GlInterface
{
    public function all(): Collection
    {
        return Gl::all();
    }

    public function index(int $perPage = 15): LengthAwarePaginator
    {
        return Gl::paginate($perPage);
    }

    public function create(array $data): Gl
    {
        return Gl::create($data);
    }

    public function read(int $id): ?Gl
    {
        return Gl::find($id);
    }

    public function update(int $id, array $data): bool
    {
        $gl = $this->read($id);
        return $gl ? $gl->update($data) : false;
    }

    public function delete(int $id): bool
    {
        $gl = $this->read($id);
        return $gl ? $gl->delete() : false;
    }

    public function getBalance(string $accountName): float
    {
        $debits = Gl::where('account_name', $accountName)->sum('debit');
        $credits = Gl::where('account_name', $accountName)->sum('credit');
        return $debits - $credits;
    }
}