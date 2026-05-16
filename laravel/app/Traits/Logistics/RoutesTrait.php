<?php

namespace App\Traits\Logistics;

use App\Services\Logistics\RoutesService;

trait RoutesTrait
{
    /**
     * @var RoutesService
     */
    protected $service;

    /**
     * Set the service for this trait.
     *
     * @param RoutesService $service
     * @return $this
     */
    public function setRoutesService(RoutesService $service)
    {
        $this->service = $service;
        return $this;
    }

    /**
     * Display all Routes records without pagination.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->service->all();
    }

    /**
     * Display a paginated listing of Routes resources.
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
     * Store a newly created Routes resource in storage.
     *
     * @param array $data
     * @return \App\Models\Logistics\Routes
     */
    public function store(array $data)
    {
        return $this->service->store($data);
    }

    /**
     * Display the specified Routes resource.
     *
     * @param int $id
     * @return \App\Models\Logistics\Routes
     */
    public function show($id)
    {
        return $this->service->show($id);
    }

    /**
     * Update the specified Routes resource in storage.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\Logistics\Routes
     */
    public function update(array $data, $id)
    {
        return $this->service->update($data, $id);
    }

    /**
     * Remove the specified Routes resource from storage.
     *
     * @param int $id
     * @return bool
     */
    public function destroy($id)
    {
        return $this->service->destroy($id);
    }
}