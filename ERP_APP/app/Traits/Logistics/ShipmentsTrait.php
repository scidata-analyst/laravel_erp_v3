<?php

namespace App\Traits\Logistics;

use App\Services\Logistics\ShipmentsService;

trait ShipmentsTrait
{
    /**
     * @var ShipmentsService
     */
    protected $service;

    /**
     * Set the service for this trait.
     *
     * @param ShipmentsService $service
     * @return $this
     */
    public function setShipmentsService(ShipmentsService $service)
    {
        $this->service = $service;
        return $this;
    }

    /**
     * Display all Shipments records without pagination.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->service->all();
    }

    /**
     * Display a paginated listing of Shipments resources.
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
     * Store a newly created Shipments resource in storage.
     *
     * @param array $data
     * @return \App\Models\Logistics\Shipments
     */
    public function store(array $data)
    {
        return $this->service->store($data);
    }

    /**
     * Display the specified Shipments resource.
     *
     * @param int $id
     * @return \App\Models\Logistics\Shipments
     */
    public function show($id)
    {
        return $this->service->show($id);
    }

    /**
     * Update the specified Shipments resource in storage.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\Logistics\Shipments
     */
    public function update(array $data, $id)
    {
        return $this->service->update($data, $id);
    }

    /**
     * Remove the specified Shipments resource from storage.
     *
     * @param int $id
     * @return bool
     */
    public function destroy($id)
    {
        return $this->service->destroy($id);
    }
}