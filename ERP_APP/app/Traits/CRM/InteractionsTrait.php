<?php

namespace App\Traits\CRM;

use App\Services\CRM\InteractionsService;

trait InteractionsTrait
{
    /**
     * @var InteractionsService
     */
    protected $service;

    /**
     * Set the service for this trait.
     *
     * @param InteractionsService $service
     * @return $this
     */
    public function setInteractionsService(InteractionsService $service)
    {
        $this->service = $service;
        return $this;
    }

    /**
     * Display all Interactions records without pagination.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->service->all();
    }

    /**
     * Display a paginated listing of Interactions resources.
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
     * Store a newly created Interactions resource in storage.
     *
     * @param array $data
     * @return \App\Models\CRM\Interactions
     */
    public function store(array $data)
    {
        return $this->service->store($data);
    }

    /**
     * Display the specified Interactions resource.
     *
     * @param int $id
     * @return \App\Models\CRM\Interactions
     */
    public function show($id)
    {
        return $this->service->show($id);
    }

    /**
     * Update the specified Interactions resource in storage.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\CRM\Interactions
     */
    public function update(array $data, $id)
    {
        return $this->service->update($data, $id);
    }

    /**
     * Remove the specified Interactions resource from storage.
     *
     * @param int $id
     * @return bool
     */
    public function destroy($id)
    {
        return $this->service->destroy($id);
    }
}