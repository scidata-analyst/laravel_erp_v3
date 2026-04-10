<?php

namespace App\Interfaces\Reports;


/**
 * Class BiDashboardsInterface
 *
 * Interface for managing BiDashboards resources.
 * Provides CRUD operations with JSON responses.
 */
interface BiDashboardsInterface
{
    /**
     * Display all BiDashboards records without pagination.
     *
     */
    public function all();

    /**
     * Display a paginated listing of BiDashboards resources.
     *
     */
    public function index();

    /**
     * Store a newly created BiDashboards resource in storage.
     *
     */
    public function store(array $request);

    /**
     * Display the specified BiDashboards resource.
     *
     * @param int $id
     */
    public function show($id);

    /**
     * Update the specified BiDashboards resource in storage.
     *
     * @param int $id
     */
    public function update(array $data, $id);

    /**
     * Remove the specified BiDashboards resource from storage.
     *
     * @param int $id
     */
    public function destroy($id);
}
