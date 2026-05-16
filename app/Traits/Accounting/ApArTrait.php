<?php

namespace App\Traits\Accounting;

use App\Services\Accounting\ApArService;

trait ApArTrait
{
    /**
     * @var ApArService
     */
    protected $service;

    /**
     * Set the service for this trait.
     *
     * @param ApArService $service
     * @return $this
     */
    public function setApArService(ApArService $service)
    {
        $this->service = $service;
        return $this;
    }

    /**
     * Display all ApAr records without pagination.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->service->all();
    }

    /**
     * Display a paginated listing of ApAr resources.
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
     * Store a newly created ApAr resource in storage.
     *
     * @param array $data
     * @return \App\Models\Accounting\ApAr
     */
    public function store(array $data)
    {
        return $this->service->store($data);
    }

    /**
     * Display the specified ApAr resource.
     *
     * @param int $id
     * @return \App\Models\Accounting\ApAr
     */
    public function show($id)
    {
        return $this->service->show($id);
    }

    /**
     * Update the specified ApAr resource in storage.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\Accounting\ApAr
     */
    public function update(array $data, $id)
    {
        return $this->service->update($data, $id);
    }

    /**
     * Remove the specified ApAr resource from storage.
     *
     * @param int $id
     * @return bool
     */
    public function destroy($id)
    {
        return $this->service->destroy($id);
    }
}