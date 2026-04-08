<?php

namespace App\Http\Interfaces\Projects;

/**
 * interface ProjectCostInterface
 *
 * Interface for managing ProjectCost resources.
 * Provides CRUD operations with JSON responses.
 */
interface ProjectCostInterface
{
    /**
     * @var ProjectCostService
     */

    /**
     * Display all ProjectCost records without pagination.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all();

    /**
     * Display a paginated listing of ProjectCost resources.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index();

    /**
     * Store a newly created ProjectCost resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(array $data);

    /**
     * Display the specified ProjectCost resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id);

    /**
     * Update the specified ProjectCost resource in storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(array $data, $id);

    /**
     * Remove the specified ProjectCost resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id);
}
