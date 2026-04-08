<?php

namespace App\Services\Reports;

use App\Models\Reports\Forecasting;

/**
 * Class ForecastingService
 *
 * Service for managing Forecasting resources.
 * Provides CRUD operations with JSON responses.
 */
class ForecastingService
{
    /**
     * @var ForecastingService
     */
    protected $forecastingService;

    /**
     * ForecastingService constructor.
     *
     */
    public function __construct()
    {
        
    }

    /**
     * Display all Forecasting records without pagination.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all()
    {
        $data = $this->forecastingService->all();
    }

    /**
     * Display a paginated listing of Forecasting resources.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created Forecasting resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(array $data)
    {
        
    }

    /**
     * Display the specified Forecasting resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        
    }

    /**
     * Update the specified Forecasting resource in storage.
     *
     * @param ForecastingRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, array $data)
    {
        
    }

    /**
     * Remove the specified Forecasting resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        
    }
}
