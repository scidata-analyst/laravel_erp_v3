<?php

namespace App\Repositories\Inventory;

use App\Models\Inventory\StockValuation;
use App\Interfaces\Inventory\StockValuationInterface;

/**
 * Class StockValuationRepository
 *
 * Repository for managing StockValuation resources.
 * Provides CRUD operations with database queries.
 */
class StockValuationRepository implements StockValuationInterface
{
    /**
     * @var StockValuation
     */
    protected $model;

    /**
     * StockValuationRepository constructor.
     *
     * @param StockValuation $model
     */
    public function __construct(StockValuation $model)
    {
        $this->model = $model;
    }

    /**
     * Display all StockValuation records without pagination.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Display a paginated listing of StockValuation resources.
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
            $query->where('product_name', 'like', "%{$search}%");
        }

        return $query->paginate($perPage);
    }

    /**
     * Store a newly created StockValuation resource in storage.
     *
     * @param array $data
     * @return \App\Models\Inventory\StockValuation
     */
    public function store(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Display the specified StockValuation resource.
     *
     * @param int $id
     * @return \App\Models\Inventory\StockValuation
     */
    public function show($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Update the specified StockValuation resource in storage.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\Inventory\StockValuation
     */
    public function update(array $data, $id)
    {
        $record = $this->model->findOrFail($id);
        $record->update($data);
        return $record;
    }

    /**
     * Remove the specified StockValuation resource from storage.
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