<?php

namespace App\Interfaces\Inventory;


/**
 * Class BatchTrackingInterface
 *
 * Interface for managing BatchTracking resources.
 * Provides CRUD operations with JSON responses.
 */
interface BatchTrackingInterface
{
    /**
     * Display all BatchTracking records without pagination.
     *
     */
    public function all();

    /**
     * Display a paginated listing of BatchTracking resources.
     *
     */
    public function index();

    /**
     * Store a newly created BatchTracking resource in storage.
     *
     */
    public function store(array $request);

    /**
     * Display the specified BatchTracking resource.
     *
     * @param int $id
     */
    public function show($id);

    /**
     * Update the specified BatchTracking resource in storage.
     *
     * @param int $id
     */
    public function update(array $data, $id);

    /**
     * Remove the specified BatchTracking resource from storage.
     *
     * @param int $id
     */
    public function destroy($id);
}
