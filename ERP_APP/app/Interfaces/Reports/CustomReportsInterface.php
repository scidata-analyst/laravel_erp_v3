<?php

namespace App\Interfaces\Reports;


/**
 * Class CustomReportsInterface
 *
 * Interface for managing CustomReports resources.
 * Provides CRUD operations with JSON responses.
 */
interface CustomReportsInterface
{
    /**
     * Display all CustomReports records without pagination.
     *
     */
    public function all();

    /**
     * Display a paginated listing of CustomReports resources.
     *
     */
    public function index();

    /**
     * Store a newly created CustomReports resource in storage.
     *
     */
    public function store(array $request);

    /**
     * Display the specified CustomReports resource.
     *
     * @param int $id
     */
    public function show($id);

    /**
     * Update the specified CustomReports resource in storage.
     *
     * @param int $id
     */
    public function update(array $data, $id);

    /**
     * Remove the specified CustomReports resource from storage.
     *
     * @param int $id
     */
    public function destroy($id);
}
