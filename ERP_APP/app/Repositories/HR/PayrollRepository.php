<?php

namespace App\Repositories\HR;

use App\Models\HR\Payroll;

/**
 * Class PayrollRepository
 *
 * Repository for managing Payroll resources.
 * Provides CRUD operations with database queries.
 */
class PayrollRepository
{
    /**
     * @var Payroll
     */
    protected $model;

    /**
     * PayrollRepository constructor.
     *
     * @param Payroll $model
     */
    public function __construct(Payroll $model)
    {
        $this->model = $model;
    }

    /**
     * Display all Payroll records without pagination.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Display a paginated listing of Payroll resources.
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
     * Store a newly created Payroll resource in storage.
     *
     * @param array $data
     * @return \App\Models\HR\Payroll
     */
    public function store(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Display the specified Payroll resource.
     *
     * @param int $id
     * @return \App\Models\HR\Payroll
     */
    public function show($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Update the specified Payroll resource in storage.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\HR\Payroll
     */
    public function update($id, array $data)
    {
        $record = $this->model->findOrFail($id);
        $record->update($data);
        return $record;
    }

    /**
     * Remove the specified Payroll resource from storage.
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