<?php

namespace App\Constants\Logistics;

use App\Models\Logistics\Warehouses;

/**
 * Class WarehousesConstant
 *
 * Constant for managing Warehouses resources.
 * Provides CRUD operations with JSON responses.
 */
class WarehousesConstant
{
    /**
     * @var WarehousesConstant
     */
    protected $warehousesConstant;

    /**
     * WarehousesConstant constructor.
     *
     */
    public function __construct()
    {
        
    }

    /**
     * Display all Warehouses records without pagination.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all()
    {
        $data = $this->warehousesConstant->all();
    }

    /**
     * Display a paginated listing of Warehouses resources.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created Warehouses resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(array $data)
    {
        
    }

    /**
     * Display the specified Warehouses resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        
    }

    /**
     * Update the specified Warehouses resource in storage.
     *
     * @param WarehousesRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, array $data)
    {
        
    }

    /**
     * Remove the specified Warehouses resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        
    }
}
