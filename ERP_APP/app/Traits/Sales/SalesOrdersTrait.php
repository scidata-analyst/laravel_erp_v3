<?php

namespace App\Traits\Sales;

use App\Services\Sales\SalesOrdersService;

trait SalesOrdersTrait
{
    /**
     * @var SalesOrdersService
     */
    protected $service;

    /**
     * Set the service for this trait.
     *
     * @param SalesOrdersService $service
     * @return $this
     */
    public function setSalesOrdersService(SalesOrdersService $service)
    {
        $this->service = $service;
        return $this;
    }

    /**
     * Display all SalesOrders records without pagination.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->service->all();
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
        return $this->service->index($perPage, $search, $filters);
    }

    /**
     * Store a newly created SalesOrders resource in storage.
     *
     * @param array $data
     * @return \App\Models\Sales\SalesOrders
     */
    public function store(array $data)
    {
        return $this->service->store($data);
    }

    /**
     * Display the specified SalesOrders resource.
     *
     * @param int $id
     * @return \App\Models\Sales\SalesOrders
     */
    public function show($id)
    {
        return $this->service->show($id);
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
        return $this->service->update($data, $id);
    }

    /**
     * Remove the specified SalesOrders resource from storage.
     *
     * @param int $id
     * @return bool
     */
    public function destroy($id)
    {
        return $this->service->destroy($id);
    }
}