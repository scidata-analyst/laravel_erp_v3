<?php

namespace App\Repositories\HR;

use App\Models\HR\Performance;
use App\Interfaces\HR\PerformanceInterface;

/**
 * Class PerformanceRepository
 *
 * Repository for managing Performance resources.
 * Provides CRUD operations with database queries.
 */
class PerformanceRepository implements PerformanceInterface
{
    /**
     * @var Performance
     */
    protected $model;

    /**
     * PerformanceRepository constructor.
     *
     * @param Performance $model
     */
    public function __construct(Performance $model)
    {
        $this->model = $model;
    }

    /**
     * Display all Performance records without pagination.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Display a paginated listing of Performance resources.
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
            $query->where('employee_name', 'like', "%{$search}%");
        }

        return $query->paginate($perPage);
    }

    /**
     * Store a newly created Performance resource in storage.
     *
     * @param array $data
     * @return \App\Models\HR\Performance
     */
    public function store(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Display the specified Performance resource.
     *
     * @param int $id
     * @return \App\Models\HR\Performance
     */
    public function show($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Update the specified Performance resource in storage.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\HR\Performance
     */
    public function update(array $data, $id)
    {
        $record = $this->model->findOrFail($id);
        $record->update($data);
        return $record;
    }

    /**
     * Remove the specified Performance resource from storage.
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