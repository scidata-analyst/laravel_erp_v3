<?php

namespace App\Repositories\Projects;

use App\Models\Projects\Tasks;
use App\Interfaces\Projects\TasksInterface;

/**
 * Class TasksRepository
 *
 * Repository for managing Tasks resources.
 * Provides CRUD operations with database queries.
 */
class TasksRepository implements TasksInterface
{
    /**
     * @var Tasks
     */
    protected $model;

    /**
     * TasksRepository constructor.
     *
     * @param Tasks $model
     */
    public function __construct(Tasks $model)
    {
        $this->model = $model;
    }

    /**
     * Display all Tasks records without pagination.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Display a paginated listing of Tasks resources.
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
     * Store a newly created Tasks resource in storage.
     *
     * @param array $data
     * @return \App\Models\Projects\Tasks
     */
    public function store(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Display the specified Tasks resource.
     *
     * @param int $id
     * @return \App\Models\Projects\Tasks
     */
    public function show($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Update the specified Tasks resource in storage.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\Projects\Tasks
     */
    public function update(array $data, $id)
    {
        $record = $this->model->findOrFail($id);
        $record->update($data);
        return $record;
    }

    /**
     * Remove the specified Tasks resource from storage.
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