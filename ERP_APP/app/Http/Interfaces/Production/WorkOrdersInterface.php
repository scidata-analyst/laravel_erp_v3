<?php

namespace App\Http\Interfaces\Production;

/**
 * interface WorkOrdersInterface
 *
 * Interface for managing WorkOrders resources.
 * Provides CRUD operations with JSON responses.
 */
interface WorkOrdersInterface
{
    /**
     * @var WorkOrdersService
     */

    /**
     * Display all WorkOrders records without pagination.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all();

    /**
     * Display a paginated listing of WorkOrders resources.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index();

    /**
     * Store a newly created WorkOrders resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(array $data);

    /**
     * Display the specified WorkOrders resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id);

    /**
     * Update the specified WorkOrders resource in storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(array $data, $id);

    /**
     * Remove the specified WorkOrders resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id);
}
