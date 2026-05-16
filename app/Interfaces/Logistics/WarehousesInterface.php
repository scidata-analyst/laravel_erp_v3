<?php

namespace App\Interfaces\Logistics;


/**
 * Class WarehousesInterface
 *
 * Interface for managing Warehouses resources.
 * Provides CRUD operations with JSON responses.
 */
interface WarehousesInterface
{
    /**
     * Display all Warehouses records without pagination.
     *
     */
    public function all();

    /**
     * Display a paginated listing of Warehouses resources.
     *
     */
    public function index();

    /**
     * Store a newly created Warehouses resource in storage.
     *
     */
    public function store(array $request);

    /**
     * Display the specified Warehouses resource.
     *
     * @param int $id
     */
    public function show($id);

    /**
     * Update the specified Warehouses resource in storage.
     *
     * @param int $id
     */
    public function update(array $data, $id);

    /**
     * Remove the specified Warehouses resource from storage.
     *
     * @param int $id
     */
    public function destroy($id);
}
