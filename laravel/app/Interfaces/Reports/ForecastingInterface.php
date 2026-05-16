<?php

namespace App\Interfaces\Reports;


/**
 * Class ForecastingInterface
 *
 * Interface for managing Forecasting resources.
 * Provides CRUD operations with JSON responses.
 */
interface ForecastingInterface
{
    /**
     * Display all Forecasting records without pagination.
     *
     */
    public function all();

    /**
     * Display a paginated listing of Forecasting resources.
     *
     */
    public function index();

    /**
     * Store a newly created Forecasting resource in storage.
     *
     */
    public function store(array $request);

    /**
     * Display the specified Forecasting resource.
     *
     * @param int $id
     */
    public function show($id);

    /**
     * Update the specified Forecasting resource in storage.
     *
     * @param int $id
     */
    public function update(array $data, $id);

    /**
     * Remove the specified Forecasting resource from storage.
     *
     * @param int $id
     */
    public function destroy($id);
}
