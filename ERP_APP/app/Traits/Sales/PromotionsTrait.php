<?php

namespace App\Traits\Sales;

use App\Services\Sales\PromotionsService;

trait PromotionsTrait
{
    /**
     * @var PromotionsService
     */
    protected $service;

    /**
     * Set the service for this trait.
     *
     * @param PromotionsService $service
     * @return $this
     */
    public function setPromotionsService(PromotionsService $service)
    {
        $this->service = $service;
        return $this;
    }

    /**
     * Display all Promotions records without pagination.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->service->all();
    }

    /**
     * Display a paginated listing of Promotions resources.
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
     * Store a newly created Promotions resource in storage.
     *
     * @param array $data
     * @return \App\Models\Sales\Promotions
     */
    public function store(array $data)
    {
        return $this->service->store($data);
    }

    /**
     * Display the specified Promotions resource.
     *
     * @param int $id
     * @return \App\Models\Sales\Promotions
     */
    public function show($id)
    {
        return $this->service->show($id);
    }

    /**
     * Update the specified Promotions resource in storage.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\Sales\Promotions
     */
    public function update(array $data, $id)
    {
        return $this->service->update($data, $id);
    }

    /**
     * Remove the specified Promotions resource from storage.
     *
     * @param int $id
     * @return bool
     */
    public function destroy($id)
    {
        return $this->service->destroy($id);
    }
}