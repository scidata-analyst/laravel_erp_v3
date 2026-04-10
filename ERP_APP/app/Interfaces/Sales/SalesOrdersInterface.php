<?php

namespace App\Interfaces\Sales;


/**
 * Class SalesOrdersInterface
 *
 * Interface for managing SalesOrders resources.
 * Provides CRUD operations with JSON responses.
 */
interface SalesOrdersInterface
{
    /**
     * Display all SalesOrders records without pagination.
     *
     */
    public function all();

    /**
     * Display a paginated listing of SalesOrders resources.
     *
     */
    public function index();

    /**
     * Store a newly created SalesOrders resource in storage.
     *
     */
    public function store(array $request);

    /**
     * Display the specified SalesOrders resource.
     *
     * @param int $id
     */
    public function show($id);

    /**
     * Update the specified SalesOrders resource in storage.
     *
     * @param int $id
     */
    public function update(array $data, $id);

    /**
     * Remove the specified SalesOrders resource from storage.
     *
     * @param int $id
     */
    public function destroy($id);
}
