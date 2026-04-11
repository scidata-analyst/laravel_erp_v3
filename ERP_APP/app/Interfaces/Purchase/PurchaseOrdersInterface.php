<?php

namespace App\Interfaces\Purchase;


/**
 * Class PurchaseOrdersInterface
 *
 * Interface for managing PurchaseOrders resources.
 * Provides CRUD operations with JSON responses.
 */
interface PurchaseOrdersInterface
{
    /**
     * Display all PurchaseOrders records without pagination.
     *
     */
    public function all();

    /**
     * Display a paginated listing of PurchaseOrders resources.
     *
     */
    public function index();

    /**
     * Store a newly created PurchaseOrders resource in storage.
     *
     */
    public function store(array $request);

    /**
     * Display the specified PurchaseOrders resource.
     *
     * @param int $id
     */
    public function show($id);

    /**
     * Update the specified PurchaseOrders resource in storage.
     *
     * @param int $id
     */
    public function update(array $data, $id);

    /**
     * Remove the specified PurchaseOrders resource from storage.
     *
     * @param int $id
     */
    public function destroy($id);
}
