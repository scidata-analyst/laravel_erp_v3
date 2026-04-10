<?php

namespace App\Repositories\Purchase;

use App\Models\Purchase\PurchaseOrders;
use App\Interfaces\Purchase\PurchaseOrdersInterface;

/**
 * Class PurchaseOrdersRepository
 *
 * Repository for managing PurchaseOrders resources.
 * Provides CRUD operations with database queries.
 */
class PurchaseOrdersRepository implements PurchaseOrdersInterface
{
    /**
     * @var PurchaseOrders
     */
    protected $model;

    /**
     * PurchaseOrdersRepository constructor.
     *
     * @param PurchaseOrders $model
     */
    public function __construct(PurchaseOrders $model)
    {
        $this->model = $model;
    }

    /**
     * Display all PurchaseOrders records without pagination.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Display a paginated listing of PurchaseOrders resources.
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
     * Store a newly created PurchaseOrders resource in storage.
     *
     * @param array $data
     * @return \App\Models\Purchase\PurchaseOrders
     */
    public function store(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Display the specified PurchaseOrders resource.
     *
     * @param int $id
     * @return \App\Models\Purchase\PurchaseOrders
     */
    public function show($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Update the specified PurchaseOrders resource in storage.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\Purchase\PurchaseOrders
     */
    public function update(array $data, $id)
    {
        $record = $this->model->findOrFail($id);
        $record->update($data);
        return $record;
    }

    /**
     * Remove the specified PurchaseOrders resource from storage.
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