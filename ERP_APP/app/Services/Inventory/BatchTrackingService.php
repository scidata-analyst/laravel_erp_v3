<?php

namespace App\Services\Inventory;

use App\Models\Inventory\BatchTracking;

/**
 * Class BatchTrackingService
 *
 * Service for managing BatchTracking resources.
 * Provides CRUD operations with JSON responses.
 */
class BatchTrackingService
{
    /**
     * @var BatchTrackingService
     */
    protected $batchTrackingService;

    /**
     * BatchTrackingService constructor.
     *
     */
    public function __construct()
    {
        
    }

    /**
     * Display all BatchTracking records without pagination.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all()
    {
        $data = $this->batchTrackingService->all();
    }

    /**
     * Display a paginated listing of BatchTracking resources.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created BatchTracking resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(array $data)
    {
        
    }

    /**
     * Display the specified BatchTracking resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        
    }

    /**
     * Update the specified BatchTracking resource in storage.
     *
     * @param BatchTrackingRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, array $data)
    {
        
    }

    /**
     * Remove the specified BatchTracking resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        
    }
}
