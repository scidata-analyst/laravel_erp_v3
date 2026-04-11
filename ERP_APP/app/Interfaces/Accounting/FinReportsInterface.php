<?php

namespace App\Interfaces\Accounting;


/**
 * Class FinReportsInterface
 *
 * Interface for managing FinReports resources.
 * Provides CRUD operations with JSON responses.
 */
interface FinReportsInterface
{
    /**
     * Display all FinReports records without pagination.
     *
     */
    public function all();

    /**
     * Display a paginated listing of FinReports resources.
     *
     */
    public function index();

    /**
     * Store a newly created FinReports resource in storage.
     *
     */
    public function store(array $request);

    /**
     * Display the specified FinReports resource.
     *
     * @param int $id
     */
    public function show($id);

    /**
     * Update the specified FinReports resource in storage.
     *
     * @param int $id
     */
    public function update(array $data, $id);

    /**
     * Remove the specified FinReports resource from storage.
     *
     * @param int $id
     */
    public function destroy($id);
}
