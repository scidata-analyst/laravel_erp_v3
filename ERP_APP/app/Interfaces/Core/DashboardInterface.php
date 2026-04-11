<?php

namespace App\Interfaces\Core;


/**
 * Class DashboardInterface
 *
 * Interface for managing Dashboard resources.
 * Provides CRUD operations with JSON responses.
 */
interface DashboardInterface
{
    /**
     * Display all Dashboard records without pagination.
     *
     */
    public function all();

    /**
     * Display a paginated listing of Dashboard resources.
     *
     */
    public function index();

    /**
     * Store a newly created Dashboard resource in storage.
     *
     */
    public function store(array $request);

    /**
     * Display the specified Dashboard resource.
     *
     * @param int $id
     */
    public function show($id);

    /**
     * Update the specified Dashboard resource in storage.
     *
     * @param int $id
     */
    public function update(array $data, $id);

    /**
     * Remove the specified Dashboard resource from storage.
     *
     * @param int $id
     */
    public function destroy($id);
}
