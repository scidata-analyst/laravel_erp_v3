<?php

namespace App\Http\Interfaces\Core;

/**
 * interface DashboardInterface
 *
 * Interface for managing Dashboard resources.
 * Provides CRUD operations with JSON responses.
 */
interface DashboardInterface
{
    /**
     * @var DashboardService
     */

    /**
     * Display all Dashboard records without pagination.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all();

    /**
     * Display a paginated listing of Dashboard resources.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index();

    /**
     * Store a newly created Dashboard resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(array $data);

    /**
     * Display the specified Dashboard resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id);

    /**
     * Update the specified Dashboard resource in storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(array $data, $id);

    /**
     * Remove the specified Dashboard resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id);
}
