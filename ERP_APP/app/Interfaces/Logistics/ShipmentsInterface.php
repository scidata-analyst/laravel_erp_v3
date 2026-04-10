<?php

namespace App\Interfaces\Logistics;


/**
 * Class ShipmentsInterface
 *
 * Interface for managing Shipments resources.
 * Provides CRUD operations with JSON responses.
 */
interface ShipmentsInterface
{
    /**
     * Display all Shipments records without pagination.
     *
     */
    public function all();

    /**
     * Display a paginated listing of Shipments resources.
     *
     */
    public function index();

    /**
     * Store a newly created Shipments resource in storage.
     *
     */
    public function store(array $request);

    /**
     * Display the specified Shipments resource.
     *
     * @param int $id
     */
    public function show($id);

    /**
     * Update the specified Shipments resource in storage.
     *
     * @param int $id
     */
    public function update(array $data, $id);

    /**
     * Remove the specified Shipments resource from storage.
     *
     * @param int $id
     */
    public function destroy($id);
}
