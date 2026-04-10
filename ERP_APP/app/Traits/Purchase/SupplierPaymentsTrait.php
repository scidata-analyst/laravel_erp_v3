<?php

namespace App\Traits\Purchase;

use App\Services\Purchase\SupplierPaymentsService;

trait SupplierPaymentsTrait
{
    /**
     * @var SupplierPaymentsService
     */
    protected $service;

    /**
     * Set the service for this trait.
     *
     * @param SupplierPaymentsService $service
     * @return $this
     */
    public function setSupplierPaymentsService(SupplierPaymentsService $service)
    {
        $this->service = $service;
        return $this;
    }

    /**
     * Display all SupplierPayments records without pagination.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->service->all();
    }

    /**
     * Display a paginated listing of SupplierPayments resources.
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
     * Store a newly created SupplierPayments resource in storage.
     *
     * @param array $data
     * @return \App\Models\Purchase\SupplierPayments
     */
    public function store(array $data)
    {
        return $this->service->store($data);
    }

    /**
     * Display the specified SupplierPayments resource.
     *
     * @param int $id
     * @return \App\Models\Purchase\SupplierPayments
     */
    public function show($id)
    {
        return $this->service->show($id);
    }

    /**
     * Update the specified SupplierPayments resource in storage.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\Purchase\SupplierPayments
     */
    public function update(array $data, $id)
    {
        return $this->service->update($data, $id);
    }

    /**
     * Remove the specified SupplierPayments resource from storage.
     *
     * @param int $id
     * @return bool
     */
    public function destroy($id)
    {
        return $this->service->destroy($id);
    }
}