<?php

namespace App\Traits\QualityControl;

use App\Services\QualityControl\QcChecklistsService;

trait QcChecklistsTrait
{
    /**
     * @var QcChecklistsService
     */
    protected $service;

    /**
     * Set the service for this trait.
     *
     * @param QcChecklistsService $service
     * @return $this
     */
    public function setQcChecklistsService(QcChecklistsService $service)
    {
        $this->service = $service;
        return $this;
    }

    /**
     * Display all QcChecklists records without pagination.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->service->all();
    }

    /**
     * Display a paginated listing of QcChecklists resources.
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
     * Store a newly created QcChecklists resource in storage.
     *
     * @param array $data
     * @return \App\Models\QualityControl\QcChecklists
     */
    public function store(array $data)
    {
        return $this->service->store($data);
    }

    /**
     * Display the specified QcChecklists resource.
     *
     * @param int $id
     * @return \App\Models\QualityControl\QcChecklists
     */
    public function show($id)
    {
        return $this->service->show($id);
    }

    /**
     * Update the specified QcChecklists resource in storage.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\QualityControl\QcChecklists
     */
    public function update(array $data, $id)
    {
        return $this->service->update($data, $id);
    }

    /**
     * Remove the specified QcChecklists resource from storage.
     *
     * @param int $id
     * @return bool
     */
    public function destroy($id)
    {
        return $this->service->destroy($id);
    }
}