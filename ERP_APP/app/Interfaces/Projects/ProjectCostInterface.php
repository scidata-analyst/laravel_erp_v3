<?php

namespace App\Interfaces\Projects;


/**
 * Class ProjectCostInterface
 *
 * Interface for managing ProjectCost resources.
 * Provides CRUD operations with JSON responses.
 */
interface ProjectCostInterface
{
    /**
     * Display all ProjectCost records without pagination.
     *
     */
    public function all();

    /**
     * Display a paginated listing of ProjectCost resources.
     *
     */
    public function index();

    /**
     * Store a newly created ProjectCost resource in storage.
     *
     */
    public function store(array $request);

    /**
     * Display the specified ProjectCost resource.
     *
     * @param int $id
     */
    public function show($id);

    /**
     * Update the specified ProjectCost resource in storage.
     *
     * @param int $id
     */
    public function update(array $data, $id);

    /**
     * Remove the specified ProjectCost resource from storage.
     *
     * @param int $id
     */
    public function destroy($id);
}
