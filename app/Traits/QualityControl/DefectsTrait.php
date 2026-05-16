<?php

namespace App\Traits\QualityControl;

use App\Services\QualityControl\DefectsService;

trait DefectsTrait
{
    /**
     * @var DefectsService
     */
    protected $service;

    /**
     * Set the service for this trait.
     *
     * @param DefectsService $service
     * @return $this
     */
    public function setDefectsService(DefectsService $service)
    {
        $this->service = $service;
        return $this;
    }

    /**
     * Display all Defects records without pagination.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->service->all();
    }

    /**
     * Display a paginated listing of Defects resources.
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
     * Store a newly created Defects resource in storage.
     *
     * @param array $data
     * @return \App\Models\QualityControl\Defects
     */
    public function store(array $data)
    {
        return $this->service->store($data);
    }

    /**
     * Display the specified Defects resource.
     *
     * @param int $id
     * @return \App\Models\QualityControl\Defects
     */
    public function show($id)
    {
        return $this->service->show($id);
    }

    /**
     * Update the specified Defects resource in storage.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\QualityControl\Defects
     */
    public function update(array $data, $id)
    {
        return $this->service->update($data, $id);
    }

    /**
     * Remove the specified Defects resource from storage.
     *
     * @param int $id
     * @return bool
     */
    public function destroy($id)
    {
        return $this->service->destroy($id);
    }
}