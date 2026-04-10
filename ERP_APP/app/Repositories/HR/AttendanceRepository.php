<?php

namespace App\Repositories\HR;

use App\Models\HR\Attendance;

/**
 * Class AttendanceRepository
 *
 * Repository for managing Attendance resources.
 * Provides CRUD operations with database queries.
 */
class AttendanceRepository
{
    /**
     * @var Attendance
     */
    protected $model;

    /**
     * AttendanceRepository constructor.
     *
     * @param Attendance $model
     */
    public function __construct(Attendance $model)
    {
        $this->model = $model;
    }

    /**
     * Display all Attendance records without pagination.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Display a paginated listing of Attendance resources.
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
     * Store a newly created Attendance resource in storage.
     *
     * @param array $data
     * @return \App\Models\HR\Attendance
     */
    public function store(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Display the specified Attendance resource.
     *
     * @param int $id
     * @return \App\Models\HR\Attendance
     */
    public function show($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Update the specified Attendance resource in storage.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\HR\Attendance
     */
    public function update($id, array $data)
    {
        $record = $this->model->findOrFail($id);
        $record->update($data);
        return $record;
    }

    /**
     * Remove the specified Attendance resource from storage.
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