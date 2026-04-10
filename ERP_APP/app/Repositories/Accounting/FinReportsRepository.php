<?php

namespace App\Repositories\Accounting;

use App\Models\Accounting\FinReports;

/**
 * Class FinReportsRepository
 *
 * Repository for managing FinReports resources.
 * Provides CRUD operations with database queries.
 */
class FinReportsRepository
{
    /**
     * @var FinReports
     */
    protected $model;

    /**
     * FinReportsRepository constructor.
     *
     * @param FinReports $model
     */
    public function __construct(FinReports $model)
    {
        $this->model = $model;
    }

    /**
     * Display all FinReports records without pagination.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Display a paginated listing of FinReports resources.
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
     * Store a newly created FinReports resource in storage.
     *
     * @param array $data
     * @return \App\Models\Accounting\FinReports
     */
    public function store(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Display the specified FinReports resource.
     *
     * @param int $id
     * @return \App\Models\Accounting\FinReports
     */
    public function show($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Update the specified FinReports resource in storage.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\Accounting\FinReports
     */
    public function update($id, array $data)
    {
        $record = $this->model->findOrFail($id);
        $record->update($data);
        return $record;
    }

    /**
     * Remove the specified FinReports resource from storage.
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