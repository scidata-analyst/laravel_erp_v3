<?php

namespace App\Repositories\Documents;

use App\Models\Documents\DocLibrary;

/**
 * Class DocLibraryRepository
 *
 * Repository for managing DocLibrary resources.
 * Provides CRUD operations with database queries.
 */
class DocLibraryRepository
{
    /**
     * @var DocLibrary
     */
    protected $model;

    /**
     * DocLibraryRepository constructor.
     *
     * @param DocLibrary $model
     */
    public function __construct(DocLibrary $model)
    {
        $this->model = $model;
    }

    /**
     * Display all DocLibrary records without pagination.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Display a paginated listing of DocLibrary resources.
     *
     * @param int $perPage
     * @param string $search
     * @param array $filters
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function index($perPage = 15, $search = '', $filters = [])
    {
        $query = $this->model->query();

        if ($search) {
            $query->where('title', 'like', "%{$search}%");
        }

        return $query->paginate($perPage);
    }

    /**
     * Store a newly created DocLibrary resource in storage.
     *
     * @param array $data
     * @return \App\Models\Documents\DocLibrary
     */
    public function store(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Display the specified DocLibrary resource.
     *
     * @param int $id
     * @return \App\Models\Documents\DocLibrary
     */
    public function show($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Update the specified DocLibrary resource in storage.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\Documents\DocLibrary
     */
    public function update($id, array $data)
    {
        $record = $this->model->findOrFail($id);
        $record->update($data);
        return $record;
    }

    /**
     * Remove the specified DocLibrary resource from storage.
     *
     * @param int $id
     * @return bool
     */
    public function destroy($id)
    {
        $record = $this->model->findOrFail($id);
        return $record->delete();
    }
}