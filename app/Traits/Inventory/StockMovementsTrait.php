<?php

namespace App\Traits\Inventory;

use App\Services\Inventory\StockMovementsService;

trait StockMovementsTrait
{
    /**
     * @var StockMovementsService
     */
    protected $service;

    /**
     * Set the service for this trait.
     *
     * @param StockMovementsService $service
     * @return $this
     */
    public function setStockMovementsService(StockMovementsService $service)
    {
        $this->service = $service;
        return $this;
    }

    /**
     * Display all StockMovements records without pagination.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->service->all();
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
        return $this->service->index($perPage, $search, $filters);
    }

    /**
     * Store a newly created StockMovements resource in storage.
     *
     * @param array $data
     * @return \App\Models\Inventory\StockMovements
     */
    public function store(array $data)
    {
        return $this->service->store($data);
    }

    /**
     * Display the specified StockMovements resource.
     *
     * @param int $id
     * @return \App\Models\Inventory\StockMovements
     */
    public function show($id)
    {
        return $this->service->show($id);
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
        return $this->service->update($data, $id);
    }

    /**
     * Remove the specified StockMovements resource from storage.
     *
     * @param int $id
     * @return bool
     */
    public function destroy($id)
    {
        return $this->service->destroy($id);
    }
}