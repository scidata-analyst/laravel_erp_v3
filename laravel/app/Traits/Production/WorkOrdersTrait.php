<?php

namespace App\Traits\Production;

use App\Services\Production\WorkOrdersService;

trait WorkOrdersTrait
{
    /**
     * @var WorkOrdersService
     */
    protected $service;

    /**
     * Set the service for this trait.
     *
     * @param WorkOrdersService $service
     * @return $this
     */
    public function setWorkOrdersService(WorkOrdersService $service)
    {
        $this->service = $service;
        return $this;
    }

    /**
     * Display all WorkOrders records without pagination.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->service->all();
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
        return $this->service->index($perPage, $search, $filters);
    }

    /**
     * Store a newly created WorkOrders resource in storage.
     *
     * @param array $data
     * @return \App\Models\Production\WorkOrders
     */
    public function store(array $data)
    {
        return $this->service->store($data);
    }

    /**
     * Display the specified WorkOrders resource.
     *
     * @param int $id
     * @return \App\Models\Production\WorkOrders
     */
    public function show($id)
    {
        return $this->service->show($id);
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
        return $this->service->update($data, $id);
    }

    /**
     * Remove the specified WorkOrders resource from storage.
     *
     * @param int $id
     * @return bool
     */
    public function destroy($id)
    {
        return $this->service->destroy($id);
    }
}