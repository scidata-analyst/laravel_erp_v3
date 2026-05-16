<?php

namespace App\Traits\Core;

use App\Services\Core\DashboardService;

trait DashboardTrait
{
    /**
     * @var DashboardService
     */
    protected $service;

    /**
     * Set the service for this trait.
     *
     * @param DashboardService $service
     * @return $this
     */
    public function setDashboardService(DashboardService $service)
    {
        $this->service = $service;
        return $this;
    }

    /**
     * Display all Dashboard records without pagination.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->service->all();
    }

    /**
     * Display a paginated listing of Dashboard resources.
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
     * Store a newly created Dashboard resource in storage.
     *
     * @param array $data
     * @return \App\Models\Core\Dashboard
     */
    public function store(array $data)
    {
        return $this->service->store($data);
    }

    /**
     * Display the specified Dashboard resource.
     *
     * @param int $id
     * @return \App\Models\Core\Dashboard
     */
    public function show($id)
    {
        return $this->service->show($id);
    }

    /**
     * Update the specified Dashboard resource in storage.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\Core\Dashboard
     */
    public function update(array $data, $id)
    {
        return $this->service->update($data, $id);
    }

    /**
     * Remove the specified Dashboard resource from storage.
     *
     * @param int $id
     * @return bool
     */
    public function destroy($id)
    {
        return $this->service->destroy($id);
    }
}