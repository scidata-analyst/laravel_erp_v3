<?php

namespace App\Repositories\Sales;

use App\Models\Sales\SalesOrders;
use App\Interfaces\Sales\SalesOrdersInterface;

/**
 * Class SalesOrdersRepository
 *
 * Repository for managing SalesOrders resources.
 * Provides CRUD operations with database queries.
 */
class SalesOrdersRepository implements SalesOrdersInterface
{
    /**
     * @var SalesOrders
     */
    protected $model;

    /**
     * SalesOrdersRepository constructor.
     *
     * @param SalesOrders $model
     */
    public function __construct(SalesOrders $model)
    {
        $this->model = $model;
    }

    /**
     * Display all SalesOrders records without pagination.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Display a paginated listing of SalesOrders resources.
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
     * Store a newly created SalesOrders resource in storage.
     *
     * @param array $data
     * @return \App\Models\Sales\SalesOrders
     */
    public function store(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Display the specified SalesOrders resource.
     *
     * @param int $id
     * @return \App\Models\Sales\SalesOrders
     */
    public function show($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Update the specified SalesOrders resource in storage.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\Sales\SalesOrders
     */
    public function update(array $data, $id)
    {
        $record = $this->model->findOrFail($id);
        $record->update($data);
        return $record;
    }

    /**
     * Remove the specified SalesOrders resource from storage.
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