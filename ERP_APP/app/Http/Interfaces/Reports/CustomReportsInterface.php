<?php

namespace App\Http\Interfaces\Reports;

/**
 * interface CustomReportsInterface
 *
 * Interface for managing CustomReports resources.
 * Provides CRUD operations with JSON responses.
 */
interface CustomReportsInterface
{
    /**
     * @var CustomReportsService
     */

    /**
     * Display all CustomReports records without pagination.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all();

    /**
     * Display a paginated listing of CustomReports resources.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index();

    /**
     * Store a newly created CustomReports resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(array $data);

    /**
     * Display the specified CustomReports resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id);

    /**
     * Update the specified CustomReports resource in storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(array $data, $id);

    /**
     * Remove the specified CustomReports resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id);
}
