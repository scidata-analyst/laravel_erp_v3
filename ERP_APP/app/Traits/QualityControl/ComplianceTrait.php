<?php

namespace App\Traits\QualityControl;

use App\Services\QualityControl\ComplianceService;

trait ComplianceTrait
{
    /**
     * @var ComplianceService
     */
    protected $service;

    /**
     * Set the service for this trait.
     *
     * @param ComplianceService $service
     * @return $this
     */
    public function setComplianceService(ComplianceService $service)
    {
        $this->service = $service;
        return $this;
    }

    /**
     * Display all Compliance records without pagination.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->service->all();
    }

    /**
     * Display a paginated listing of Compliance resources.
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
     * Store a newly created Compliance resource in storage.
     *
     * @param array $data
     * @return \App\Models\QualityControl\Compliance
     */
    public function store(array $data)
    {
        return $this->service->store($data);
    }

    /**
     * Display the specified Compliance resource.
     *
     * @param int $id
     * @return \App\Models\QualityControl\Compliance
     */
    public function show($id)
    {
        return $this->service->show($id);
    }

    /**
     * Update the specified Compliance resource in storage.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\QualityControl\Compliance
     */
    public function update(array $data, $id)
    {
        return $this->service->update($data, $id);
    }

    /**
     * Remove the specified Compliance resource from storage.
     *
     * @param int $id
     * @return bool
     */
    public function destroy($id)
    {
        return $this->service->destroy($id);
    }
}