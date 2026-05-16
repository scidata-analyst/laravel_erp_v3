<?php

namespace App\Traits\Ecommerce;

use App\Services\Ecommerce\InvSyncService;

trait InvSyncTrait
{
    /**
     * @var InvSyncService
     */
    protected $service;

    /**
     * Set the service for this trait.
     *
     * @param InvSyncService $service
     * @return $this
     */
    public function setInvSyncService(InvSyncService $service)
    {
        $this->service = $service;
        return $this;
    }

    /**
     * Display all InvSync records without pagination.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->service->all();
    }

    /**
     * Display a paginated listing of InvSync resources.
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
     * Store a newly created InvSync resource in storage.
     *
     * @param array $data
     * @return \App\Models\Ecommerce\InvSync
     */
    public function store(array $data)
    {
        return $this->service->store($data);
    }

    /**
     * Display the specified InvSync resource.
     *
     * @param int $id
     * @return \App\Models\Ecommerce\InvSync
     */
    public function show($id)
    {
        return $this->service->show($id);
    }

    /**
     * Update the specified InvSync resource in storage.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\Ecommerce\InvSync
     */
    public function update(array $data, $id)
    {
        return $this->service->update($data, $id);
    }

    /**
     * Remove the specified InvSync resource from storage.
     *
     * @param int $id
     * @return bool
     */
    public function destroy($id)
    {
        return $this->service->destroy($id);
    }
}