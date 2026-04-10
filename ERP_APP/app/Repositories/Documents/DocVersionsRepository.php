<?php

namespace App\Repositories\Documents;

use App\Models\Documents\DocVersions;
use App\Interfaces\Documents\DocVersionsInterface;

/**
 * Class DocVersionsRepository
 *
 * Repository for managing DocVersions resources.
 * Provides CRUD operations with database queries.
 */
class DocVersionsRepository implements DocVersionsInterface
{
    /**
     * @var DocVersions
     */
    protected $model;

    /**
     * DocVersionsRepository constructor.
     *
     * @param DocVersions $model
     */
    public function __construct(DocVersions $model)
    {
        $this->model = $model;
    }

    /**
     * Display all DocVersions records without pagination.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Display a paginated listing of DocVersions resources.
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
            $query->where('version', 'like', "%{$search}%");
        }

        return $query->paginate($perPage);
    }

    /**
     * Store a newly created DocVersions resource in storage.
     *
     * @param array $data
     * @return \App\Models\Documents\DocVersions
     */
    public function store(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Display the specified DocVersions resource.
     *
     * @param int $id
     * @return \App\Models\Documents\DocVersions
     */
    public function show($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Update the specified DocVersions resource in storage.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\Documents\DocVersions
     */
    public function update(array $data, $id)
    {
        $record = $this->model->findOrFail($id);
        $record->update($data);
        return $record;
    }

    /**
     * Remove the specified DocVersions resource from storage.
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