<?php

namespace App\Repositories\Production;

use App\Models\Production\WorkOrders;
use App\Interfaces\Production\WorkOrdersInterface;

/**
 * Class WorkOrdersRepository
 *
 * Repository for managing WorkOrders resources.
 * Provides CRUD operations with database queries.
 */
class WorkOrdersRepository implements WorkOrdersInterface
{
    /**
     * @var WorkOrders
     */
    protected $model;

    /**
     * WorkOrdersRepository constructor.
     *
     * @param WorkOrders $model
     */
    public function __construct(WorkOrders $model)
    {
        $this->model = $model;
    }

    /**
     * Display all WorkOrders records without pagination.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Display a paginated listing of WorkOrders resources.
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
            $query->where('order_number', 'like', "%{$search}%");
        }

        return $query->paginate($perPage);
    }

    /**
     * Store a newly created WorkOrders resource in storage.
     *
     * @param array $data
     * @return \App\Models\Production\WorkOrders
     */
    public function store(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Display the specified WorkOrders resource.
     *
     * @param int $id
     * @return \App\Models\Production\WorkOrders
     */
    public function show($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Update the specified WorkOrders resource in storage.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\Production\WorkOrders
     */
    public function update(array $data, $id)
    {
        $record = $this->model->findOrFail($id);
        $record->update($data);
        return $record;
    }

    /**
     * Remove the specified WorkOrders resource from storage.
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