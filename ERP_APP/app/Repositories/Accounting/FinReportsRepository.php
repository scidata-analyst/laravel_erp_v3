<?php

namespace App\Repositories\Accounting;

use App\Interfaces\Accounting\FinReportsInterface;
use App\Models\Accounting\FinReports;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class FinReportsRepository implements FinReportsInterface
{
    public function all(): Collection
    {
        return FinReports::all();
    }

    public function index(int $perPage = 15): LengthAwarePaginator
    {
        return FinReports::paginate($perPage);
    }

    public function create(array $data): FinReports
    {
        return FinReports::create($data);
    }

    public function read(int $id): ?FinReports
    {
        return FinReports::find($id);
    }

    public function update(int $id, array $data): bool
    {
        $report = $this->read($id);
        return $report ? $report->update($data) : false;
    }

    public function delete(int $id): bool
    {
        $report = $this->read($id);
        return $report ? $report->delete() : false;
    }

    public function getByType(string $type): Collection
    {
        return FinReports::where('report_type', $type)->get();
    }
}