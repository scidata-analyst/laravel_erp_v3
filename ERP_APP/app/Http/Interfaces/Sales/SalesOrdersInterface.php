<?php

namespace App\Http\Interfaces\Sales;

/**
 * interface SalesOrdersInterface
 *
 * Interface for managing SalesOrders resources.
 * Provides CRUD operations with JSON responses.
 */
interface SalesOrdersInterface
{
    /**
     * @var SalesOrdersService
     */

    /**
     * Display all SalesOrders records without pagination.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all();

    /**
     * Display a paginated listing of SalesOrders resources.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index();

    /**
     * Store a newly created SalesOrders resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(array $data);

    /**
     * Display the specified SalesOrders resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id);

    /**
     * Update the specified SalesOrders resource in storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(array $data, $id);

    /**
     * Remove the specified SalesOrders resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id);
}
