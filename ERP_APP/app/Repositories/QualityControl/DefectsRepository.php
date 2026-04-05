<?php

namespace App\Repositories\QualityControl;

use App\Interfaces\QualityControl\DefectsInterface;
use App\Models\QualityControl\Defects;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class DefectsRepository implements DefectsInterface
{
    public function all(): Collection
    {
        return Defects::all();
    }

    public function index(int $perPage = 15): LengthAwarePaginator
    {
        return Defects::with(['product', 'detectedBy', 'compliance'])->paginate($perPage);
    }

    public function create(array $data): Defects
    {
        return Defects::create($data);
    }

    public function read(int $id): ?Defects
    {
        return Defects::with(['product', 'detectedBy', 'compliance'])->find($id);
    }

    public function update(int $id, array $data): bool
    {
        $defect = $this->read($id);
        return $defect ? $defect->update($data) : false;
    }

    public function delete(int $id): bool
    {
        $defect = $this->read($id);
        return $defect ? $defect->delete() : false;
    }

    public function resolve(int $id, string $resolution): bool
    {
        $defect = $this->read($id);
        if (!$defect) return false;

        return $defect->update([
            'status' => 'resolved',
            'resolution' => $resolution,
            'resolution_date' => now()
        ]);
    }
}
