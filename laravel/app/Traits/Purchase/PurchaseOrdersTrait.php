<?php

namespace App\Traits\Purchase;

use App\Services\Purchase\PurchaseOrdersService;

trait PurchaseOrdersTrait
{
    /**
     * @var PurchaseOrdersService
     */
    protected $service;

    /**
     * Set the service for this trait.
     *
     * @param PurchaseOrdersService $service
     * @return $this
     */
    public function setPurchaseOrdersService(PurchaseOrdersService $service)
    {
        $this->service = $service;
        return $this;
    }

    /**
     * Display all PurchaseOrders records without pagination.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->service->all();
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
        return $this->service->index($perPage, $search, $filters);
    }

    /**
     * Store a newly created PurchaseOrders resource in storage.
     *
     * @param array $data
     * @return \App\Models\Purchase\PurchaseOrders
     */
    public function store(array $data)
    {
        return $this->service->store($data);
    }

    /**
     * Display the specified PurchaseOrders resource.
     *
     * @param int $id
     * @return \App\Models\Purchase\PurchaseOrders
     */
    public function show($id)
    {
        return $this->service->show($id);
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
        return $this->service->update($data, $id);
    }

    /**
     * Remove the specified PurchaseOrders resource from storage.
     *
     * @param int $id
     * @return bool
     */
    public function destroy($id)
    {
        return $this->service->destroy($id);
    }
}