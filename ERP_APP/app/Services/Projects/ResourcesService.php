<?php

namespace App\Services\Projects;

use App\Models\Projects\Resources;

/**
 * Class ResourcesService
 *
 * Service for managing Resources resources.
 * Provides CRUD operations with JSON responses.
 */
class ResourcesService
{
    /**
     * @var ResourcesService
     */
    protected $resourcesService;

    /**
     * ResourcesService constructor.
     *
     */
    public function __construct()
    {
        
    }

    /**
     * Display all Resources records without pagination.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all()
    {
        $data = $this->resourcesService->all();
    }

    /**
     * Display a paginated listing of Resources resources.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created Resources resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(array $data)
    {
        
    }

    /**
     * Display the specified Resources resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        
    }

    /**
     * Update the specified Resources resource in storage.
     *
     * @param ResourcesRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, array $data)
    {
        
    }

    /**
     * Remove the specified Resources resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        
    }
}
