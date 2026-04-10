<?php

namespace App\Traits\Projects;

use App\Services\Projects\ResourcesService;

trait ResourcesTrait
{
    /**
     * @var ResourcesService
     */
    protected $service;

    /**
     * Set the service for this trait.
     *
     * @param ResourcesService $service
     * @return $this
     */
    public function setResourcesService(ResourcesService $service)
    {
        $this->service = $service;
        return $this;
    }

    /**
     * Display all Resources records without pagination.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->service->all();
    }

    /**
     * Display a paginated listing of Resources resources.
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
     * Store a newly created Resources resource in storage.
     *
     * @param array $data
     * @return \App\Models\Projects\Resources
     */
    public function store(array $data)
    {
        return $this->service->store($data);
    }

    /**
     * Display the specified Resources resource.
     *
     * @param int $id
     * @return \App\Models\Projects\Resources
     */
    public function show($id)
    {
        return $this->service->show($id);
    }

    /**
     * Update the specified Resources resource in storage.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\Projects\Resources
     */
    public function update(array $data, $id)
    {
        return $this->service->update($data, $id);
    }

    /**
     * Remove the specified Resources resource from storage.
     *
     * @param int $id
     * @return bool
     */
    public function destroy($id)
    {
        return $this->service->destroy($id);
    }
}