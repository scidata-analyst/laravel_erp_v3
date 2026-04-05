<?php

namespace App\Repositories\Documents;

use App\Interfaces\Documents\DocLibraryInterface;
use App\Models\Documents\DocLibrary;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class DocLibraryRepository implements DocLibraryInterface
{
    public function all(): Collection
    {
        return DocLibrary::all();
    }

    public function index(int $perPage = 15): LengthAwarePaginator
    {
        return DocLibrary::with(['uploadedBy', 'versions'])->paginate($perPage);
    }

    public function create(array $data): DocLibrary
    {
        return DocLibrary::create($data);
    }

    public function read(int $id): ?DocLibrary
    {
        return DocLibrary::with(['uploadedBy', 'versions'])->find($id);
    }

    public function update(int $id, array $data): bool
    {
        $doc = $this->read($id);
        return $doc ? $doc->update($data) : false;
    }

    public function delete(int $id): bool
    {
        $doc = $this->read($id);
        return $doc ? $doc->delete() : false;
    }

    public function getByCategory(string $category): Collection
    {
        return DocLibrary::where('category', $category)->get();
    }
}
