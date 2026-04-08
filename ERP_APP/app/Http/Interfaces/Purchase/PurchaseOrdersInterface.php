<?php

namespace App\Http\Interfaces\Purchase;

/**
 * interface PurchaseOrdersInterface
 *
 * Interface for managing PurchaseOrders resources.
 * Provides CRUD operations with JSON responses.
 */
interface PurchaseOrdersInterface
{
    /**
     * @var PurchaseOrdersService
     */

    /**
     * Display all PurchaseOrders records without pagination.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all();

    /**
     * Display a paginated listing of PurchaseOrders resources.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index();

    /**
     * Store a newly created PurchaseOrders resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(array $data);

    /**
     * Display the specified PurchaseOrders resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id);

    /**
     * Update the specified PurchaseOrders resource in storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(array $data, $id);

    /**
     * Remove the specified PurchaseOrders resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id);
}
