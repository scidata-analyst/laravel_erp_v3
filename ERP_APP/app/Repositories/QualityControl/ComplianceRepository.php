<?php

namespace App\Repositories\QualityControl;

use App\Interfaces\QualityControl\ComplianceInterface;
use App\Models\QualityControl\Compliance;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class ComplianceRepository implements ComplianceInterface
{
    public function all(): Collection
    {
        return Compliance::all();
    }

    public function index(int $perPage = 15): LengthAwarePaginator
    {
        return Compliance::with(['auditor', 'relatedDefects'])->paginate($perPage);
    }

    public function create(array $data): Compliance
    {
        return Compliance::create($data);
    }

    public function read(int $id): ?Compliance
    {
        return Compliance::with(['auditor', 'relatedDefects'])->find($id);
    }

    public function update(int $id, array $data): bool
    {
        $compliance = $this->read($id);
        return $compliance ? $compliance->update($data) : false;
    }

    public function delete(int $id): bool
    {
        $compliance = $this->read($id);
        return $compliance ? $compliance->delete() : false;
    }

    public function getByCategory(string $category): Collection
    {
        return Compliance::where('compliance_type', $category)->get();
    }

    public function getActiveStandards(): Collection
    {
        return Compliance::where('status', 'completed')->get();
    }
}
