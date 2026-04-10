<?php

namespace App\Traits\Production;

use App\Services\Production\MachineLaborService;

trait MachineLaborTrait
{
    /**
     * @var MachineLaborService
     */
    protected $service;

    /**
     * Set the service for this trait.
     *
     * @param MachineLaborService $service
     * @return $this
     */
    public function setMachineLaborService(MachineLaborService $service)
    {
        $this->service = $service;
        return $this;
    }

    /**
     * Display all MachineLabor records without pagination.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->service->all();
    }

    /**
     * Display a paginated listing of MachineLabor resources.
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
     * Store a newly created MachineLabor resource in storage.
     *
     * @param array $data
     * @return \App\Models\Production\MachineLabor
     */
    public function store(array $data)
    {
        return $this->service->store($data);
    }

    /**
     * Display the specified MachineLabor resource.
     *
     * @param int $id
     * @return \App\Models\Production\MachineLabor
     */
    public function show($id)
    {
        return $this->service->show($id);
    }

    /**
     * Update the specified MachineLabor resource in storage.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\Production\MachineLabor
     */
    public function update(array $data, $id)
    {
        return $this->service->update($data, $id);
    }

    /**
     * Remove the specified MachineLabor resource from storage.
     *
     * @param int $id
     * @return bool
     */
    public function destroy($id)
    {
        return $this->service->destroy($id);
    }
}