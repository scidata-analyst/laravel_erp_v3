<?php

namespace App\Repositories\QualityControl;

use App\Interfaces\QualityControl\QcChecklistsInterface;
use App\Models\QualityControl\QcChecklists;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class QcChecklistsRepository implements QcChecklistsInterface
{
    public function all(): Collection
    {
        return QcChecklists::all();
    }

    public function index(int $perPage = 15): LengthAwarePaginator
    {
        return QcChecklists::paginate($perPage);
    }

    public function create(array $data): QcChecklists
    {
        return QcChecklists::create($data);
    }

    public function read(int $id): ?QcChecklists
    {
        return QcChecklists::find($id);
    }

    public function update(int $id, array $data): bool
    {
        $checklist = $this->read($id);
        return $checklist ? $checklist->update($data) : false;
    }

    public function delete(int $id): bool
    {
        $checklist = $this->read($id);
        return $checklist ? $checklist->delete() : false;
    }

    public function getByCategory(string $category): Collection
    {
        return QcChecklists::where('category', $category)->get();
    }
}