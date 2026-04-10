<?php

namespace App\Repositories\Projects;

use App\Models\Projects\ProjectCost;

/**
 * Class ProjectCostRepository
 *
 * Repository for managing ProjectCost resources.
 * Provides CRUD operations with database queries.
 */
class ProjectCostRepository
{
    /**
     * @var ProjectCost
     */
    protected $model;

    /**
     * ProjectCostRepository constructor.
     *
     * @param ProjectCost $model
     */
    public function __construct(ProjectCost $model)
    {
        $this->model = $model;
    }

    /**
     * Display all ProjectCost records without pagination.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Display a paginated listing of ProjectCost resources.
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
            $query->where('description', 'like', "%{$search}%");
        }

        return $query->paginate($perPage);
    }

    /**
     * Store a newly created ProjectCost resource in storage.
     *
     * @param array $data
     * @return \App\Models\Projects\ProjectCost
     */
    public function store(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Display the specified ProjectCost resource.
     *
     * @param int $id
     * @return \App\Models\Projects\ProjectCost
     */
    public function show($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Update the specified ProjectCost resource in storage.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\Projects\ProjectCost
     */
    public function update($id, array $data)
    {
        $record = $this->model->findOrFail($id);
        $record->update($data);
        return $record;
    }

    /**
     * Remove the specified ProjectCost resource from storage.
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