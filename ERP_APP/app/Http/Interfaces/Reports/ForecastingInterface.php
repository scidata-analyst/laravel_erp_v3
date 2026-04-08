<?php

namespace App\Http\Interfaces\Reports;

/**
 * interface ForecastingInterface
 *
 * Interface for managing Forecasting resources.
 * Provides CRUD operations with JSON responses.
 */
interface ForecastingInterface
{
    /**
     * @var ForecastingService
     */

    /**
     * Display all Forecasting records without pagination.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all();

    /**
     * Display a paginated listing of Forecasting resources.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index();

    /**
     * Store a newly created Forecasting resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(array $data);

    /**
     * Display the specified Forecasting resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id);

    /**
     * Update the specified Forecasting resource in storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(array $data, $id);

    /**
     * Remove the specified Forecasting resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id);
}
