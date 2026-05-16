<?php

namespace App\Repositories\Projects;

use App\Models\Projects\Resources;
use App\Interfaces\Projects\ResourcesInterface;

/**
 * Class ResourcesRepository
 *
 * Repository for managing Resources resources.
 * Provides CRUD operations with database queries.
 */
class ResourcesRepository implements ResourcesInterface
{
    /**
     * @var Resources
     */
    protected $model;

    /**
     * ResourcesRepository constructor.
     *
     * @param Resources $model
     */
    public function __construct(Resources $model)
    {
        $this->model = $model;
    }

    /**
     * Display all Resources records without pagination.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Display a paginated listing of Resources resources.
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
            $query->where('name', 'like', "%{$search}%");
        }

        return $query->paginate($perPage);
    }

    /**
     * Store a newly created Resources resource in storage.
     *
     * @param array $data
     * @return \App\Models\Projects\Resources
     */
    public function store(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Display the specified Resources resource.
     *
     * @param int $id
     * @return \App\Models\Projects\Resources
     */
    public function show($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Update the specified Resources resource in storage.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\Projects\Resources
     */
    public function update(array $data, $id)
    {
        $record = $this->model->findOrFail($id);
        $record->update($data);
        return $record;
    }

    /**
     * Remove the specified Resources resource from storage.
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