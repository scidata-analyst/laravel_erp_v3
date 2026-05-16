<?php

namespace App\Traits\Projects;

use App\Services\Projects\TasksService;

trait TasksTrait
{
    /**
     * @var TasksService
     */
    protected $service;

    /**
     * Set the service for this trait.
     *
     * @param TasksService $service
     * @return $this
     */
    public function setTasksService(TasksService $service)
    {
        $this->service = $service;
        return $this;
    }

    /**
     * Display all Tasks records without pagination.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->service->all();
    }

    /**
     * Display a paginated listing of Tasks resources.
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
     * Store a newly created Tasks resource in storage.
     *
     * @param array $data
     * @return \App\Models\Projects\Tasks
     */
    public function store(array $data)
    {
        return $this->service->store($data);
    }

    /**
     * Display the specified Tasks resource.
     *
     * @param int $id
     * @return \App\Models\Projects\Tasks
     */
    public function show($id)
    {
        return $this->service->show($id);
    }

    /**
     * Update the specified Tasks resource in storage.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\Projects\Tasks
     */
    public function update(array $data, $id)
    {
        return $this->service->update($data, $id);
    }

    /**
     * Remove the specified Tasks resource from storage.
     *
     * @param int $id
     * @return bool
     */
    public function destroy($id)
    {
        return $this->service->destroy($id);
    }
}