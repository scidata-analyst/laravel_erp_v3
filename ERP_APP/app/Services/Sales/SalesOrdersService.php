<?php

namespace App\Services\Sales;

use App\Models\Sales\SalesOrders;

/**
 * Class SalesOrdersService
 *
 * Service for managing SalesOrders resources.
 * Provides CRUD operations with JSON responses.
 */
class SalesOrdersService
{
    /**
     * @var SalesOrdersService
     */
    protected $salesOrdersService;

    /**
     * SalesOrdersService constructor.
     *
     */
    public function __construct()
    {
        
    }

    /**
     * Display all SalesOrders records without pagination.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all()
    {
        $data = $this->salesOrdersService->all();
    }

    /**
     * Display a paginated listing of SalesOrders resources.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created SalesOrders resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(array $data)
    {
        
    }

    /**
     * Display the specified SalesOrders resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        
    }

    /**
     * Update the specified SalesOrders resource in storage.
     *
     * @param SalesOrdersRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, array $data)
    {
        
    }

    /**
     * Remove the specified SalesOrders resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        
    }
}
