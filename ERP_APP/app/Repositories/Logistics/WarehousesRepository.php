<?php

namespace App\Repositories\Logistics;

use App\Models\Logistics\Warehouses;

/**
 * Class WarehousesRepository
 *
 * Repository for managing Warehouses resources.
 * Provides CRUD operations with database queries.
 */
class WarehousesRepository
{
    /**
     * @var Warehouses
     */
    protected $model;

    /**
     * WarehousesRepository constructor.
     *
     * @param Warehouses $model
     */
    public function __construct(Warehouses $model)
    {
        $this->model = $model;
    }

    /**
     * Display all Warehouses records without pagination.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Display a paginated listing of Warehouses resources.
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
     * Store a newly created Warehouses resource in storage.
     *
     * @param array $data
     * @return \App\Models\Logistics\Warehouses
     */
    public function store(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Display the specified Warehouses resource.
     *
     * @param int $id
     * @return \App\Models\Logistics\Warehouses
     */
    public function show($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Update the specified Warehouses resource in storage.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\Logistics\Warehouses
     */
    public function update($id, array $data)
    {
        $record = $this->model->findOrFail($id);
        $record->update($data);
        return $record;
    }

    /**
     * Remove the specified Warehouses resource from storage.
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