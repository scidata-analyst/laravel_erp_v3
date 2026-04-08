<?php

namespace App\Services\Projects;

use App\Models\Projects\ProjectCost;

/**
 * Class ProjectCostService
 *
 * Service for managing ProjectCost resources.
 * Provides CRUD operations with JSON responses.
 */
class ProjectCostService
{
    /**
     * @var ProjectCostService
     */
    protected $projectCostService;

    /**
     * ProjectCostService constructor.
     *
     */
    public function __construct()
    {
        
    }

    /**
     * Display all ProjectCost records without pagination.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all()
    {
        $data = $this->projectCostService->all();
    }

    /**
     * Display a paginated listing of ProjectCost resources.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created ProjectCost resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(array $data)
    {
        
    }

    /**
     * Display the specified ProjectCost resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        
    }

    /**
     * Update the specified ProjectCost resource in storage.
     *
     * @param ProjectCostRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, array $data)
    {
        
    }

    /**
     * Remove the specified ProjectCost resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        
    }
}
