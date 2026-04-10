<?php

namespace App\Traits\Reports;

use App\Services\Reports\BiDashboardsService;

trait BiDashboardsTrait
{
    /**
     * @var BiDashboardsService
     */
    protected $service;

    /**
     * Set the service for this trait.
     *
     * @param BiDashboardsService $service
     * @return $this
     */
    public function setBiDashboardsService(BiDashboardsService $service)
    {
        $this->service = $service;
        return $this;
    }

    /**
     * Display all BiDashboards records without pagination.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->service->all();
    }

    /**
     * Display a paginated listing of BiDashboards resources.
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
     * Store a newly created BiDashboards resource in storage.
     *
     * @param array $data
     * @return \App\Models\Reports\BiDashboards
     */
    public function store(array $data)
    {
        return $this->service->store($data);
    }

    /**
     * Display the specified BiDashboards resource.
     *
     * @param int $id
     * @return \App\Models\Reports\BiDashboards
     */
    public function show($id)
    {
        return $this->service->show($id);
    }

    /**
     * Update the specified BiDashboards resource in storage.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\Reports\BiDashboards
     */
    public function update(array $data, $id)
    {
        return $this->service->update($data, $id);
    }

    /**
     * Remove the specified BiDashboards resource from storage.
     *
     * @param int $id
     * @return bool
     */
    public function destroy($id)
    {
        return $this->service->destroy($id);
    }
}