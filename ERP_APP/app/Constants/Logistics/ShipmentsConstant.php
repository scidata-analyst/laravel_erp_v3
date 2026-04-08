<?php

namespace App\Constants\Logistics;

use App\Models\Logistics\Shipments;

/**
 * Class ShipmentsConstant
 *
 * Constant for managing Shipments resources.
 * Provides CRUD operations with JSON responses.
 */
class ShipmentsConstant
{
    /**
     * @var ShipmentsConstant
     */
    protected $shipmentsConstant;

    /**
     * ShipmentsConstant constructor.
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
        $data = $this->shipmentsConstant->all();
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
