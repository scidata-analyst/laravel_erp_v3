<?php

namespace App\Traits\Purchase;

use App\Services\Purchase\SuppliersService;

trait SuppliersTrait
{
    /**
     * @var SuppliersService
     */
    protected $service;

    /**
     * Set the service for this trait.
     *
     * @param SuppliersService $service
     * @return $this
     */
    public function setSuppliersService(SuppliersService $service)
    {
        $this->service = $service;
        return $this;
    }

    /**
     * Display all Suppliers records without pagination.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->service->all();
    }

    /**
     * Display a paginated listing of Suppliers resources.
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
     * Store a newly created Suppliers resource in storage.
     *
     * @param array $data
     * @return \App\Models\Purchase\Suppliers
     */
    public function store(array $data)
    {
        return $this->service->store($data);
    }

    /**
     * Display the specified Suppliers resource.
     *
     * @param int $id
     * @return \App\Models\Purchase\Suppliers
     */
    public function show($id)
    {
        return $this->service->show($id);
    }

    /**
     * Update the specified Suppliers resource in storage.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\Purchase\Suppliers
     */
    public function update(array $data, $id)
    {
        return $this->service->update($data, $id);
    }

    /**
     * Remove the specified Suppliers resource from storage.
     *
     * @param int $id
     * @return bool
     */
    public function destroy($id)
    {
        return $this->service->destroy($id);
    }
}