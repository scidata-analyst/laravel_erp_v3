<?php

namespace App\Constants\Production;

use App\Models\Production\WorkOrders;

/**
 * Class WorkOrdersConstant
 *
 * Constant for managing WorkOrders resources.
 * Provides CRUD operations with JSON responses.
 */
class WorkOrdersConstant
{
    /**
     * @var WorkOrdersConstant
     */
    protected $workOrdersConstant;

    /**
     * WorkOrdersConstant constructor.
     *
     */
    public function __construct()
    {
        
    }

    /**
     * Display all WorkOrders records without pagination.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all()
    {
        $data = $this->workOrdersConstant->all();
    }

    /**
     * Display a paginated listing of WorkOrders resources.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created WorkOrders resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(array $data)
    {
        
    }

    /**
     * Display the specified WorkOrders resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        
    }

    /**
     * Update the specified WorkOrders resource in storage.
     *
     * @param WorkOrdersRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, array $data)
    {
        
    }

    /**
     * Remove the specified WorkOrders resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        
    }
}
