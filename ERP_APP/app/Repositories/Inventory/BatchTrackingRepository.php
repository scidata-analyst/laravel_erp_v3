<?php

namespace App\Repositories\Inventory;

use App\Models\Inventory\BatchTracking;
use App\Interfaces\Inventory\BatchTrackingInterface;

/**
 * Class BatchTrackingRepository
 *
 * Repository for managing BatchTracking resources.
 * Provides CRUD operations with database queries.
 */
class BatchTrackingRepository implements BatchTrackingInterface
{
    /**
     * @var BatchTracking
     */
    protected $model;

    /**
     * BatchTrackingRepository constructor.
     *
     * @param BatchTracking $model
     */
    public function __construct(BatchTracking $model)
    {
        $this->model = $model;
    }

    /**
     * Display all BatchTracking records without pagination.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Display a paginated listing of BatchTracking resources.
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
            $query->where('batch_number', 'like', "%{$search}%");
        }

        return $query->paginate($perPage);
    }

    /**
     * Store a newly created BatchTracking resource in storage.
     *
     * @param array $data
     * @return \App\Models\Inventory\BatchTracking
     */
    public function store(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Display the specified BatchTracking resource.
     *
     * @param int $id
     * @return \App\Models\Inventory\BatchTracking
     */
    public function show($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Update the specified BatchTracking resource in storage.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\Inventory\BatchTracking
     */
    public function update(array $data, $id)
    {
        $record = $this->model->findOrFail($id);
        $record->update($data);
        return $record;
    }

    /**
     * Remove the specified BatchTracking resource from storage.
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