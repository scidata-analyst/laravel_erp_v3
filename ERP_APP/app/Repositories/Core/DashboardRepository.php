<?php

namespace App\Repositories\Core;

use App\Models\Core\Dashboard;
use App\Interfaces\Core\DashboardInterface;

/**
 * Class DashboardRepository
 *
 * Repository for managing Dashboard resources.
 * Provides CRUD operations with database queries.
 */
class DashboardRepository implements DashboardInterface
{
    /**
     * @var Dashboard
     */
    protected $model;

    /**
     * DashboardRepository constructor.
     *
     * @param Dashboard $model
     */
    public function __construct(Dashboard $model)
    {
        $this->model = $model;
    }

    /**
     * Display all Dashboard records without pagination.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Display a paginated listing of Dashboard resources.
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
     * Store a newly created Dashboard resource in storage.
     *
     * @param array $data
     * @return \App\Models\Core\Dashboard
     */
    public function store(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Display the specified Dashboard resource.
     *
     * @param int $id
     * @return \App\Models\Core\Dashboard
     */
    public function show($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Update the specified Dashboard resource in storage.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\Core\Dashboard
     */
    public function update(array $data, $id)
    {
        $record = $this->model->findOrFail($id);
        $record->update($data);
        return $record;
    }

    /**
     * Remove the specified Dashboard resource from storage.
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