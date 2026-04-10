<?php

namespace App\Traits\Accounting;

use App\Services\Accounting\GlService;

trait GlTrait
{
    /**
     * @var GlService
     */
    protected $service;

    /**
     * Set the service for this trait.
     *
     * @param GlService $service
     * @return $this
     */
    public function setGlService(GlService $service)
    {
        $this->service = $service;
        return $this;
    }

    /**
     * Display all Gl records without pagination.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->service->all();
    }

    /**
     * Display a paginated listing of Gl resources.
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
     * Store a newly created Gl resource in storage.
     *
     * @param array $data
     * @return \App\Models\Accounting\Gl
     */
    public function store(array $data)
    {
        return $this->service->store($data);
    }

    /**
     * Display the specified Gl resource.
     *
     * @param int $id
     * @return \App\Models\Accounting\Gl
     */
    public function show($id)
    {
        return $this->service->show($id);
    }

    /**
     * Update the specified Gl resource in storage.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\Accounting\Gl
     */
    public function update(array $data, $id)
    {
        return $this->service->update($data, $id);
    }

    /**
     * Remove the specified Gl resource from storage.
     *
     * @param int $id
     * @return bool
     */
    public function destroy($id)
    {
        return $this->service->destroy($id);
    }
}