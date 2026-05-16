<?php

namespace App\Traits\Reports;

use App\Services\Reports\ForecastingService;

trait ForecastingTrait
{
    /**
     * @var ForecastingService
     */
    protected $service;

    /**
     * Set the service for this trait.
     *
     * @param ForecastingService $service
     * @return $this
     */
    public function setForecastingService(ForecastingService $service)
    {
        $this->service = $service;
        return $this;
    }

    /**
     * Display all Forecasting records without pagination.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->service->all();
    }

    /**
     * Display a paginated listing of Forecasting resources.
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
     * Store a newly created Forecasting resource in storage.
     *
     * @param array $data
     * @return \App\Models\Reports\Forecasting
     */
    public function store(array $data)
    {
        return $this->service->store($data);
    }

    /**
     * Display the specified Forecasting resource.
     *
     * @param int $id
     * @return \App\Models\Reports\Forecasting
     */
    public function show($id)
    {
        return $this->service->show($id);
    }

    /**
     * Update the specified Forecasting resource in storage.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\Reports\Forecasting
     */
    public function update(array $data, $id)
    {
        return $this->service->update($data, $id);
    }

    /**
     * Remove the specified Forecasting resource from storage.
     *
     * @param int $id
     * @return bool
     */
    public function destroy($id)
    {
        return $this->service->destroy($id);
    }
}