<?php

namespace App\Services\Logistics;

use App\Models\Logistics\Shipments;

/**
 * Class ShipmentsService
 *
 * Service for managing Shipments resources.
 * Provides CRUD operations with JSON responses.
 */
class ShipmentsService
{
    /**
     * @var ShipmentsService
     */
    protected $shipmentsService;

    /**
     * ShipmentsService constructor.
     *
     */
    public function __construct()
    {
        
    }

    /**
     * Display all Shipments records without pagination.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all()
    {
        $data = $this->shipmentsService->all();
    }

    /**
     * Display a paginated listing of Shipments resources.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created Shipments resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(array $data)
    {
        
    }

    /**
     * Display the specified Shipments resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        
    }

    /**
     * Update the specified Shipments resource in storage.
     *
     * @param ShipmentsRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, array $data)
    {
        
    }

    /**
     * Remove the specified Shipments resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        
    }
}
