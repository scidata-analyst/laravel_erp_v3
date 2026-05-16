<?php

namespace App\Repositories\Logistics;

use App\Models\Logistics\Routes;
use App\Interfaces\Logistics\RoutesInterface;

/**
 * Class RoutesRepository
 *
 * Repository for managing Routes resources.
 * Provides CRUD operations with database queries.
 */
class RoutesRepository implements RoutesInterface
{
    /**
     * @var Routes
     */
    protected $model;

    /**
     * RoutesRepository constructor.
     *
     * @param Routes $model
     */
    public function __construct(Routes $model)
    {
        $this->model = $model;
    }

    /**
     * Display all Routes records without pagination.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Display a paginated listing of Routes resources.
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
     * Store a newly created Routes resource in storage.
     *
     * @param array $data
     * @return \App\Models\Logistics\Routes
     */
    public function store(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Display the specified Routes resource.
     *
     * @param int $id
     * @return \App\Models\Logistics\Routes
     */
    public function show($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Update the specified Routes resource in storage.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\Logistics\Routes
     */
    public function update(array $data, $id)
    {
        $record = $this->model->findOrFail($id);
        $record->update($data);
        return $record;
    }

    /**
     * Remove the specified Routes resource from storage.
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