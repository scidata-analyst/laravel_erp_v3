<?php

namespace App\Traits\Ecommerce;

use App\Services\Ecommerce\PosService;

trait PosTrait
{
    /**
     * @var PosService
     */
    protected $service;

    /**
     * Set the service for this trait.
     *
     * @param PosService $service
     * @return $this
     */
    public function setPosService(PosService $service)
    {
        $this->service = $service;
        return $this;
    }

    /**
     * Display all Pos records without pagination.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->service->all();
    }

    /**
     * Display a paginated listing of Pos resources.
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
     * Store a newly created Pos resource in storage.
     *
     * @param array $data
     * @return \App\Models\Ecommerce\Pos
     */
    public function store(array $data)
    {
        return $this->service->store($data);
    }

    /**
     * Display the specified Pos resource.
     *
     * @param int $id
     * @return \App\Models\Ecommerce\Pos
     */
    public function show($id)
    {
        return $this->service->show($id);
    }

    /**
     * Update the specified Pos resource in storage.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\Ecommerce\Pos
     */
    public function update(array $data, $id)
    {
        return $this->service->update($data, $id);
    }

    /**
     * Remove the specified Pos resource from storage.
     *
     * @param int $id
     * @return bool
     */
    public function destroy($id)
    {
        return $this->service->destroy($id);
    }
}