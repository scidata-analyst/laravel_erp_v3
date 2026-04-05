<?php

namespace App\Repositories\Documents;

use App\Interfaces\Documents\DocVersionsInterface;
use App\Models\Documents\DocVersions;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class DocVersionsRepository implements DocVersionsInterface
{
    public function all(): Collection
    {
        return DocVersions::all();
    }

    public function index(int $perPage = 15): LengthAwarePaginator
    {
        return DocVersions::with(['document', 'createdBy', 'approvedBy'])->paginate($perPage);
    }

    public function create(array $data): DocVersions
    {
        return DocVersions::create($data);
    }

    public function read(int $id): ?DocVersions
    {
        return DocVersions::with(['document', 'createdBy', 'approvedBy'])->find($id);
    }

    public function update(int $id, array $data): bool
    {
        $version = $this->read($id);
        return $version ? $version->update($data) : false;
    }

    public function delete(int $id): bool
    {
        $version = $this->read($id);
        return $version ? $version->delete() : false;
    }

    public function getByDocument(int $documentId): Collection
    {
        return DocVersions::where('doc_library_id', $documentId)->orderBy('version_number', 'desc')->get();
    }
}
