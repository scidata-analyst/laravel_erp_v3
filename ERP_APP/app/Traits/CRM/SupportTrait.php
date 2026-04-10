<?php

namespace App\Traits\CRM;

use App\Services\CRM\SupportService;

trait SupportTrait
{
    /**
     * @var SupportService
     */
    protected $service;

    /**
     * Set the service for this trait.
     *
     * @param SupportService $service
     * @return $this
     */
    public function setSupportService(SupportService $service)
    {
        $this->service = $service;
        return $this;
    }

    /**
     * Display all Support records without pagination.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->service->all();
    }

    /**
     * Display a paginated listing of Support resources.
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
     * Store a newly created Support resource in storage.
     *
     * @param array $data
     * @return \App\Models\CRM\Support
     */
    public function store(array $data)
    {
        return $this->service->store($data);
    }

    /**
     * Display the specified Support resource.
     *
     * @param int $id
     * @return \App\Models\CRM\Support
     */
    public function show($id)
    {
        return $this->service->show($id);
    }

    /**
     * Update the specified Support resource in storage.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\CRM\Support
     */
    public function update(array $data, $id)
    {
        return $this->service->update($data, $id);
    }

    /**
     * Remove the specified Support resource from storage.
     *
     * @param int $id
     * @return bool
     */
    public function destroy($id)
    {
        return $this->service->destroy($id);
    }
}