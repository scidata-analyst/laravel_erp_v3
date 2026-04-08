<?php

namespace App\Services\Purchase;

use App\Models\Purchase\PurchaseOrders;

/**
 * Class PurchaseOrdersService
 *
 * Service for managing PurchaseOrders resources.
 * Provides CRUD operations with JSON responses.
 */
class PurchaseOrdersService
{
    /**
     * @var PurchaseOrdersService
     */
    protected $purchaseOrdersService;

    /**
     * PurchaseOrdersService constructor.
     *
     */
    public function __construct()
    {
        
    }

    /**
     * Display all PurchaseOrders records without pagination.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all()
    {
        $data = $this->purchaseOrdersService->all();
    }

    /**
     * Display a paginated listing of PurchaseOrders resources.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created PurchaseOrders resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(array $data)
    {
        
    }

    /**
     * Display the specified PurchaseOrders resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        
    }

    /**
     * Update the specified PurchaseOrders resource in storage.
     *
     * @param PurchaseOrdersRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, array $data)
    {
        
    }

    /**
     * Remove the specified PurchaseOrders resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        
    }
}
