<?php

namespace App\Traits\Purchase;

use App\Services\Purchase\GrnService;

trait GrnTrait
{
    /**
     * @var GrnService
     */
    protected $service;

    /**
     * Set the service for this trait.
     *
     * @param GrnService $service
     * @return $this
     */
    public function setGrnService(GrnService $service)
    {
        $this->service = $service;
        return $this;
    }

    /**
     * Display all Grn records without pagination.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->service->all();
    }

    /**
     * Display a paginated listing of Grn resources.
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
     * Store a newly created Grn resource in storage.
     *
     * @param array $data
     * @return \App\Models\Purchase\Grn
     */
    public function store(array $data)
    {
        return $this->service->store($data);
    }

    /**
     * Display the specified Grn resource.
     *
     * @param int $id
     * @return \App\Models\Purchase\Grn
     */
    public function show($id)
    {
        return $this->service->show($id);
    }

    /**
     * Update the specified Grn resource in storage.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\Purchase\Grn
     */
    public function update(array $data, $id)
    {
        return $this->service->update($data, $id);
    }

    /**
     * Remove the specified Grn resource from storage.
     *
     * @param int $id
     * @return bool
     */
    public function destroy($id)
    {
        return $this->service->destroy($id);
    }
}