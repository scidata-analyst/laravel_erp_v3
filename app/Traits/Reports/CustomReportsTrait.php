<?php

namespace App\Traits\Reports;

use App\Services\Reports\CustomReportsService;

trait CustomReportsTrait
{
    /**
     * @var CustomReportsService
     */
    protected $service;

    /**
     * Set the service for this trait.
     *
     * @param CustomReportsService $service
     * @return $this
     */
    public function setCustomReportsService(CustomReportsService $service)
    {
        $this->service = $service;
        return $this;
    }

    /**
     * Display all CustomReports records without pagination.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->service->all();
    }

    /**
     * Display a paginated listing of CustomReports resources.
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
     * Store a newly created CustomReports resource in storage.
     *
     * @param array $data
     * @return \App\Models\Reports\CustomReports
     */
    public function store(array $data)
    {
        return $this->service->store($data);
    }

    /**
     * Display the specified CustomReports resource.
     *
     * @param int $id
     * @return \App\Models\Reports\CustomReports
     */
    public function show($id)
    {
        return $this->service->show($id);
    }

    /**
     * Update the specified CustomReports resource in storage.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\Reports\CustomReports
     */
    public function update(array $data, $id)
    {
        return $this->service->update($data, $id);
    }

    /**
     * Remove the specified CustomReports resource from storage.
     *
     * @param int $id
     * @return bool
     */
    public function destroy($id)
    {
        return $this->service->destroy($id);
    }
}