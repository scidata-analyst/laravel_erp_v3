<?php

namespace App\Traits\Core;

use App\Services\Core\SettingsService;

trait SettingsTrait
{
    /**
     * @var SettingsService
     */
    protected $service;

    /**
     * Set the service for this trait.
     *
     * @param SettingsService $service
     * @return $this
     */
    public function setSettingsService(SettingsService $service)
    {
        $this->service = $service;
        return $this;
    }

    /**
     * Display all Settings records without pagination.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->service->all();
    }

    /**
     * Display a paginated listing of Settings resources.
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
     * Store a newly created Settings resource in storage.
     *
     * @param array $data
     * @return \App\Models\Core\Settings
     */
    public function store(array $data)
    {
        return $this->service->store($data);
    }

    /**
     * Display the specified Settings resource.
     *
     * @param int $id
     * @return \App\Models\Core\Settings
     */
    public function show($id)
    {
        return $this->service->show($id);
    }

    /**
     * Update the specified Settings resource in storage.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\Core\Settings
     */
    public function update(array $data, $id)
    {
        return $this->service->update($data, $id);
    }

    /**
     * Remove the specified Settings resource from storage.
     *
     * @param int $id
     * @return bool
     */
    public function destroy($id)
    {
        return $this->service->destroy($id);
    }
}