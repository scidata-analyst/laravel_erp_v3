<?php

namespace App\Traits\Documents;

use App\Services\Documents\DocVersionsService;

trait DocVersionsTrait
{
    /**
     * @var DocVersionsService
     */
    protected $service;

    /**
     * Set the service for this trait.
     *
     * @param DocVersionsService $service
     * @return $this
     */
    public function setDocVersionsService(DocVersionsService $service)
    {
        $this->service = $service;
        return $this;
    }

    /**
     * Display all DocVersions records without pagination.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->service->all();
    }

    /**
     * Display a paginated listing of DocVersions resources.
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
     * Store a newly created DocVersions resource in storage.
     *
     * @param array $data
     * @return \App\Models\Documents\DocVersions
     */
    public function store(array $data)
    {
        return $this->service->store($data);
    }

    /**
     * Display the specified DocVersions resource.
     *
     * @param int $id
     * @return \App\Models\Documents\DocVersions
     */
    public function show($id)
    {
        return $this->service->show($id);
    }

    /**
     * Update the specified DocVersions resource in storage.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\Documents\DocVersions
     */
    public function update(array $data, $id)
    {
        return $this->service->update($data, $id);
    }

    /**
     * Remove the specified DocVersions resource from storage.
     *
     * @param int $id
     * @return bool
     */
    public function destroy($id)
    {
        return $this->service->destroy($id);
    }
}