<?php

namespace App\Traits\HR;

use App\Services\HR\PayrollService;

trait PayrollTrait
{
    /**
     * @var PayrollService
     */
    protected $service;

    /**
     * Set the service for this trait.
     *
     * @param PayrollService $service
     * @return $this
     */
    public function setPayrollService(PayrollService $service)
    {
        $this->service = $service;
        return $this;
    }

    /**
     * Display all Payroll records without pagination.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->service->all();
    }

    /**
     * Display a paginated listing of Payroll resources.
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
     * Store a newly created Payroll resource in storage.
     *
     * @param array $data
     * @return \App\Models\HR\Payroll
     */
    public function store(array $data)
    {
        return $this->service->store($data);
    }

    /**
     * Display the specified Payroll resource.
     *
     * @param int $id
     * @return \App\Models\HR\Payroll
     */
    public function show($id)
    {
        return $this->service->show($id);
    }

    /**
     * Update the specified Payroll resource in storage.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\HR\Payroll
     */
    public function update(array $data, $id)
    {
        return $this->service->update($data, $id);
    }

    /**
     * Remove the specified Payroll resource from storage.
     *
     * @param int $id
     * @return bool
     */
    public function destroy($id)
    {
        return $this->service->destroy($id);
    }
}