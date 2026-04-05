<?php

namespace App\Repositories\Reports;

use App\Interfaces\Reports\CustomReportsInterface;
use App\Models\Reports\CustomReports;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class CustomReportsRepository implements CustomReportsInterface
{
    public function all(): Collection
    {
        return CustomReports::all();
    }

    public function index(int $perPage = 15): LengthAwarePaginator
    {
        return CustomReports::paginate($perPage);
    }

    public function create(array $data): CustomReports
    {
        return CustomReports::create($data);
    }

    public function read(int $id): ?CustomReports
    {
        return CustomReports::find($id);
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

    public function getByModule(string $module): Collection
    {
        return CustomReports::where('module', $module)->get();
    }
}