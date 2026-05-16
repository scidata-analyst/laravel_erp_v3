<?php

namespace App\Repositories\Reports;

use App\Models\Reports\CustomReports;
use App\Interfaces\Reports\CustomReportsInterface;

/**
 * Class CustomReportsRepository
 *
 * Repository for managing CustomReports resources.
 * Provides CRUD operations with database queries.
 */
class CustomReportsRepository implements CustomReportsInterface
{
    /**
     * @var CustomReports
     */
    protected $model;

    /**
     * CustomReportsRepository constructor.
     *
     * @param CustomReports $model
     */
    public function __construct(CustomReports $model)
    {
        $this->model = $model;
    }

    /**
     * Display all CustomReports records without pagination.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Display a paginated listing of CustomReports resources.
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
     * Store a newly created CustomReports resource in storage.
     *
     * @param array $data
     * @return \App\Models\Reports\CustomReports
     */
    public function store(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Display the specified CustomReports resource.
     *
     * @param int $id
     * @return \App\Models\Reports\CustomReports
     */
    public function show($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Update the specified CustomReports resource in storage.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\Reports\CustomReports
     */
    public function update(array $data, $id)
    {
        $record = $this->model->findOrFail($id);
        $record->update($data);
        return $record;
    }

    /**
     * Remove the specified CustomReports resource from storage.
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