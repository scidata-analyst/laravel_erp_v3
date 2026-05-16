<?php

namespace App\Repositories\Inventory;

use App\Models\Inventory\StockMovements;
use App\Interfaces\Inventory\StockMovementsInterface;

/**
 * Class StockMovementsRepository
 *
 * Repository for managing StockMovements resources.
 * Provides CRUD operations with database queries.
 */
class StockMovementsRepository implements StockMovementsInterface
{
    /**
     * @var StockMovements
     */
    protected $model;

    /**
     * StockMovementsRepository constructor.
     *
     * @param StockMovements $model
     */
    public function __construct(StockMovements $model)
    {
        $this->model = $model;
    }

    /**
     * Display all StockMovements records without pagination.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Display a paginated listing of StockMovements resources.
     *
     * @param int $perPage
     * @param string $search
     * @param array $filters
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function index($perPage = 15, $search = '', $filters = [])
    {
        $query = $this->model->query()->with(['product', 'fromWarehouse', 'toWarehouse']);

        if ($search) {
            $query->whereHas('product', function ($q) use ($search) {
                $q->where('product_name', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%");
            })
            ->orWhere('movement_type', 'like', "%{$search}%")
            ->orWhere('reason', 'like', "%{$search}%");
        }

        return $query->paginate($perPage);
    }

    /**
     * Store a newly created StockMovements resource in storage.
     *
     * @param array $data
     * @return \App\Models\Inventory\StockMovements
     */
    public function store(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Display the specified StockMovements resource.
     *
     * @param int $id
     * @return \App\Models\Inventory\StockMovements
     */
    public function show($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Update the specified StockMovements resource in storage.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\Inventory\StockMovements
     */
    public function update(array $data, $id)
    {
        $record = $this->model->findOrFail($id);
        $record->update($data);
        return $record;
    }

    /**
     * Remove the specified StockMovements resource from storage.
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