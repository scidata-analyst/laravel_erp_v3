<?php

namespace App\Http\Interfaces\Logistics;

/**
 * interface WarehousesInterface
 *
 * Interface for managing Warehouses resources.
 * Provides CRUD operations with JSON responses.
 */
interface WarehousesInterface
{
    /**
     * @var WarehousesService
     */

    /**
     * Display all Warehouses records without pagination.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all();

    /**
     * Display a paginated listing of Warehouses resources.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index();

    /**
     * Store a newly created Warehouses resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(array $data);

    /**
     * Display the specified Warehouses resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id);

    /**
     * Update the specified Warehouses resource in storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(array $data, $id);

    /**
     * Remove the specified Warehouses resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id);
}
