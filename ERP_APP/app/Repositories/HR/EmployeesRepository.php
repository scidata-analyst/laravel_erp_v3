<?php

namespace App\Repositories\HR;

use App\Models\HR\Employees;

/**
 * Class EmployeesRepository
 *
 * Repository for managing Employees resources.
 * Provides CRUD operations with database queries.
 */
class EmployeesRepository
{
    /**
     * @var Employees
     */
    protected $model;

    /**
     * EmployeesRepository constructor.
     *
     * @param Employees $model
     */
    public function __construct(Employees $model)
    {
        $this->model = $model;
    }

    /**
     * Display all Employees records without pagination.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Display a paginated listing of Employees resources.
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
     * Store a newly created Employees resource in storage.
     *
     * @param array $data
     * @return \App\Models\HR\Employees
     */
    public function store(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Display the specified Employees resource.
     *
     * @param int $id
     * @return \App\Models\HR\Employees
     */
    public function show($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Update the specified Employees resource in storage.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\HR\Employees
     */
    public function update($id, array $data)
    {
        $record = $this->model->findOrFail($id);
        $record->update($data);
        return $record;
    }

    /**
     * Remove the specified Employees resource from storage.
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