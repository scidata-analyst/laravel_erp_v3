<?php

namespace App\Traits\Inventory;

use App\Services\Inventory\StockValuationService;

trait StockValuationTrait
{
    /**
     * @var StockValuationService
     */
    protected $service;

    /**
     * Set the service for this trait.
     *
     * @param StockValuationService $service
     * @return $this
     */
    public function setStockValuationService(StockValuationService $service)
    {
        $this->service = $service;
        return $this;
    }

    /**
     * Display all StockValuation records without pagination.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->service->all();
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
        return $this->service->index($perPage, $search, $filters);
    }

    /**
     * Store a newly created StockValuation resource in storage.
     *
     * @param array $data
     * @return \App\Models\Inventory\StockValuation
     */
    public function store(array $data)
    {
        return $this->service->store($data);
    }

    /**
     * Display the specified StockValuation resource.
     *
     * @param int $id
     * @return \App\Models\Inventory\StockValuation
     */
    public function show($id)
    {
        return $this->service->show($id);
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
        return $this->service->update($data, $id);
    }

    /**
     * Remove the specified StockValuation resource from storage.
     *
     * @param int $id
     * @return bool
     */
    public function destroy($id)
    {
        return $this->service->destroy($id);
    }
}