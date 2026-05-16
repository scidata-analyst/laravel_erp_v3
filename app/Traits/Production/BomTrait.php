<?php

namespace App\Traits\Production;

use App\Services\Production\BomService;

trait BomTrait
{
    /**
     * @var BomService
     */
    protected $service;

    /**
     * Set the service for this trait.
     *
     * @param BomService $service
     * @return $this
     */
    public function setBomService(BomService $service)
    {
        $this->service = $service;
        return $this;
    }

    /**
     * Display all Bom records without pagination.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->service->all();
    }

    /**
     * Display a paginated listing of Bom resources.
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
     * Store a newly created Bom resource in storage.
     *
     * @param array $data
     * @return \App\Models\Production\Bom
     */
    public function store(array $data)
    {
        return $this->service->store($data);
    }

    /**
     * Display the specified Bom resource.
     *
     * @param int $id
     * @return \App\Models\Production\Bom
     */
    public function show($id)
    {
        return $this->service->show($id);
    }

    /**
     * Update the specified Bom resource in storage.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\Production\Bom
     */
    public function update(array $data, $id)
    {
        return $this->service->update($data, $id);
    }

    /**
     * Remove the specified Bom resource from storage.
     *
     * @param int $id
     * @return bool
     */
    public function destroy($id)
    {
        return $this->service->destroy($id);
    }
}