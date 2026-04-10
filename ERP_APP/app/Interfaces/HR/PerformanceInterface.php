<?php

namespace App\Interfaces\HR;


/**
 * Class PerformanceInterface
 *
 * Interface for managing Performance resources.
 * Provides CRUD operations with JSON responses.
 */
interface PerformanceInterface
{
    /**
     * Display all Performance records without pagination.
     *
     */
    public function all();

    /**
     * Display a paginated listing of Performance resources.
     *
     */
    public function index();

    /**
     * Store a newly created Performance resource in storage.
     *
     */
    public function store(array $request);

    /**
     * Display the specified Performance resource.
     *
     * @param int $id
     */
    public function show($id);

    /**
     * Update the specified Performance resource in storage.
     *
     * @param int $id
     */
    public function update(array $data, $id);

    /**
     * Remove the specified Performance resource from storage.
     *
     * @param int $id
     */
    public function destroy($id);
}
