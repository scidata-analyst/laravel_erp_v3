<?php

namespace App\Traits\Projects;

use App\Services\Projects\ProjectCostService;

trait ProjectCostTrait
{
    /**
     * @var ProjectCostService
     */
    protected $service;

    /**
     * Set the service for this trait.
     *
     * @param ProjectCostService $service
     * @return $this
     */
    public function setProjectCostService(ProjectCostService $service)
    {
        $this->service = $service;
        return $this;
    }

    /**
     * Display all ProjectCost records without pagination.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->service->all();
    }

    /**
     * Display a paginated listing of ProjectCost resources.
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
     * Store a newly created ProjectCost resource in storage.
     *
     * @param array $data
     * @return \App\Models\Projects\ProjectCost
     */
    public function store(array $data)
    {
        return $this->service->store($data);
    }

    /**
     * Display the specified ProjectCost resource.
     *
     * @param int $id
     * @return \App\Models\Projects\ProjectCost
     */
    public function show($id)
    {
        return $this->service->show($id);
    }

    /**
     * Update the specified ProjectCost resource in storage.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\Projects\ProjectCost
     */
    public function update(array $data, $id)
    {
        return $this->service->update($data, $id);
    }

    /**
     * Remove the specified ProjectCost resource from storage.
     *
     * @param int $id
     * @return bool
     */
    public function destroy($id)
    {
        return $this->service->destroy($id);
    }
}