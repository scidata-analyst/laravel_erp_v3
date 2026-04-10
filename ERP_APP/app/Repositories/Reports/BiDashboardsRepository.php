<?php

namespace App\Repositories\Reports;

use App\Models\Reports\BiDashboards;

/**
 * Class BiDashboardsRepository
 *
 * Repository for managing BiDashboards resources.
 * Provides CRUD operations with database queries.
 */
class BiDashboardsRepository
{
    /**
     * @var BiDashboards
     */
    protected $model;

    /**
     * BiDashboardsRepository constructor.
     *
     * @param BiDashboards $model
     */
    public function __construct(BiDashboards $model)
    {
        $this->model = $model;
    }

    /**
     * Display all BiDashboards records without pagination.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Display a paginated listing of BiDashboards resources.
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
     * Store a newly created BiDashboards resource in storage.
     *
     * @param array $data
     * @return \App\Models\Reports\BiDashboards
     */
    public function store(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Display the specified BiDashboards resource.
     *
     * @param int $id
     * @return \App\Models\Reports\BiDashboards
     */
    public function show($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Update the specified BiDashboards resource in storage.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\Reports\BiDashboards
     */
    public function update($id, array $data)
    {
        $record = $this->model->findOrFail($id);
        $record->update($data);
        return $record;
    }

    /**
     * Remove the specified BiDashboards resource from storage.
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